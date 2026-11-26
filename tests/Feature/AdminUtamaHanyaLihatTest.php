<?php

namespace Tests\Feature;

use App\Models\Bidang;
use App\Models\JabatanBidang;
use App\Models\Periode;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Laravel\Passport\Passport;
use Tests\TestCase;

class AdminUtamaHanyaLihatTest extends TestCase
{
    use RefreshDatabase;

    private Periode $p;
    private User $utama;

    protected function setUp(): void
    {
        parent::setUp();
        Carbon::setTestNow('2026-06-01');
        $this->withoutVite();
        $this->p = Periode::firstOrCreate(['tahun_mulai' => 2024, 'tahun_selesai' => 2026]);
        $this->utama = User::factory()->admin(null)->create();
    }

    protected function tearDown(): void
    {
        Carbon::setTestNow();
        parent::tearDown();
    }

    public function test_admin_utama_bisa_melihat_data()
    {
        $this->actingAs($this->utama)->get(route('jabatan.index'))->assertOk();
    }

    public function test_admin_utama_tidak_bisa_tambah_ubah_hapus()
    {
        $jabatan = JabatanBidang::forceCreate(['nama_jabatan' => 'Ketua', 'periode_id' => $this->p->id]);

        $this->actingAs($this->utama)->get(route('jabatan.create'))->assertRedirect()->assertSessionHas('error', 'Admin utama hanya bisa melihat data.');
        $this->get(route('jabatan.edit', $jabatan))->assertRedirect();
        $this->post(route('jabatan.store'), ['nama_jabatan' => 'Sekretaris'])->assertRedirect();
        $this->put(route('jabatan.update', $jabatan), ['nama_jabatan' => 'Ganti'])->assertRedirect();
        $this->delete(route('jabatan.destroy', $jabatan))->assertRedirect();

        $this->assertSame(['Ketua'], JabatanBidang::withoutGlobalScopes()->pluck('nama_jabatan')->all());
    }

    public function test_admin_utama_tetap_bisa_kelola_periode_dan_akun()
    {
        $this->actingAs($this->utama)->get(route('akun.create'))->assertOk();
        $this->post(route('akun.store'), [
            'data_anggota_id' => $this->anggota('baru@example.com')->id,
            'password' => 'rahasia123', 'password_confirmation' => 'rahasia123',
            'periode_id' => $this->p->id,
        ])->assertSessionHasNoErrors();
        $this->post(route('periode.store'), ['tahun_mulai' => 2026, 'tahun_selesai' => 2028])->assertSessionHasNoErrors();
        $this->post(route('periode.pilih'), ['periode_id' => $this->p->id])->assertSessionHasNoErrors();

        $this->assertTrue(User::where('email', 'baru@example.com')->exists());
        $this->assertTrue(Periode::where('tahun_mulai', 2026)->exists());
    }

    public function test_admin_utama_api_hanya_baca()
    {
        $this->artisan('passport:keys');
        Passport::actingAs($this->utama, [], 'api');

        $this->getJson('/api/bidang')->assertOk();
        $this->postJson('/api/bidang', ['nama_bidang' => 'X'])->assertForbidden();
        $this->assertSame(0, Bidang::withoutGlobalScopes()->count());
    }

    public function test_admin_periode_tetap_bisa_input()
    {
        $this->actingAs(User::factory()->admin($this->p)->create())
            ->post(route('jabatan.store'), ['nama_jabatan' => 'Bendahara']);

        $this->assertTrue(JabatanBidang::withoutGlobalScopes()->where('nama_jabatan', 'Bendahara')->exists());
    }
}
