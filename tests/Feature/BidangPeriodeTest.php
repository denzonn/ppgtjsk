<?php

namespace Tests\Feature;

use App\Models\AnggotaBidang;
use App\Models\Bidang;
use App\Models\JabatanBidang;
use App\Models\Periode;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Laravel\Passport\Passport;
use Tests\TestCase;

class BidangPeriodeTest extends TestCase
{
    use RefreshDatabase;

    private $p1;
    private $p2;
    private $akun;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
        Carbon::setTestNow('2026-06-01');
        $this->p1 = Periode::firstOrCreate(['tahun_mulai' => 2024, 'tahun_selesai' => 2026]);
        $this->p2 = Periode::firstOrCreate(['tahun_mulai' => 2026, 'tahun_selesai' => 2028]);
        $this->akun = User::factory()->admin($this->p2)->create();
    }

    protected function tearDown(): void
    {
        Carbon::setTestNow();
        parent::tearDown();
    }

    private function bidang(string $nama, $periode, $maks = null): Bidang
    {
        return Bidang::create(['nama_bidang' => $nama, 'foto_bidang' => "foto_bidang/$nama.jpg", 'maksimal_orang' => $maks, 'periode_id' => $periode->id]);
    }

    private function pengurus(Bidang $b, string $nama = 'Budi'): AnggotaBidang
    {
        $j = JabatanBidang::create(['nama_jabatan' => 'Ketua '.$nama, 'periode_id' => $this->p2->id]);

        return AnggotaBidang::create(['nama_anggota' => $nama, 'foto' => 'x.jpg', 'jabatans_id' => $j->id, 'bidangs_id' => $b->id, 'periode_id' => $this->p2->id]);
    }

    public function test_salin_format_bidang_dari_periode_sebelumnya()
    {
        foreach (range(1, 5) as $i) {
            $b = $this->bidang("B$i", $this->p1, $i);
            if ($i === 3) {
                $asal = $b;
            }
        }
        $this->actingAs($this->akun)->post(route('bidang.salin-format'))->assertRedirect();

        $baru = Bidang::withoutGlobalScope('periode')->where('periode_id', $this->p2->id)->get();
        $this->assertCount(5, $baru);
        $b3 = $baru->firstWhere('nama_bidang', 'B3');
        $this->assertSame(3, $b3->maksimal_orang);
        $this->assertSame($asal->getRawOriginal('foto_bidang'), $b3->getRawOriginal('foto_bidang'));
    }

    public function test_salin_format_ditolak_kalau_sudah_ada_isi()
    {
        $this->bidang('Lama', $this->p1);
        $this->bidang('Ada', $this->p2);
        $this->actingAs($this->akun)->post(route('bidang.salin-format'))->assertSessionHas('error');
        $this->assertSame(1, Bidang::count());
    }

    public function test_salin_format_jabatan()
    {
        JabatanBidang::create(['nama_jabatan' => 'Ketua', 'periode_id' => $this->p1->id]);
        $this->actingAs($this->akun)->post(route('jabatan.salin-format'));
        $this->assertDatabaseHas('jabatan_bidangs', ['nama_jabatan' => 'Ketua', 'periode_id' => $this->p2->id]);
    }

    public function test_pengurus_ditolak_kalau_bidang_penuh()
    {
        $b = $this->bidang('Musik', $this->p2, 1);
        $this->pengurus($b);
        $j = JabatanBidang::first();
        $data = ['nama_anggota' => 'Ani', 'jabatans_id' => $j->id, 'bidangs_id' => $b->id,
            'foto' => \Illuminate\Http\UploadedFile::fake()->image('a.jpg')];

        $this->actingAs($this->akun)->post(route('pengurus.store'), $data)->assertSessionHasErrors('bidangs_id');
        $this->assertSame(1, AnggotaBidang::count());

        $this->artisan('passport:keys');
        Passport::actingAs($this->akun, [], 'api');
        $data['foto'] = \Illuminate\Http\UploadedFile::fake()->image('a.jpg');
        $this->post('/api/pengurus', $data, ['Accept' => 'application/json'])->assertStatus(422);
        $this->assertSame(1, AnggotaBidang::count());
    }

    public function test_edit_pengurus_di_bidang_penuh_tetap_boleh()
    {
        $b = $this->bidang('Musik', $this->p2, 1);
        $lain = $this->bidang('Multimedia', $this->p2, 5);
        $p = $this->pengurus($b);
        $q = $this->pengurus($lain, 'Cici');

        $this->actingAs($this->akun)->put(route('pengurus.update', $p->id), [
            'nama_anggota' => 'Budi Baru', 'jabatans_id' => $p->jabatans_id, 'bidangs_id' => $b->id,
        ])->assertSessionHasNoErrors();
        $this->assertSame('Budi Baru', $p->fresh()->nama_anggota);

        $this->actingAs($this->akun)->put(route('pengurus.update', $q->id), [
            'nama_anggota' => 'Cici', 'jabatans_id' => $q->jabatans_id, 'bidangs_id' => $b->id,
        ])->assertSessionHasErrors('bidangs_id');
    }
}
