<?php

namespace Tests\Feature;

use App\Models\Bidang;
use App\Models\JabatanBidang;
use App\Models\Periode;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

class IsolasiPeriodeTest extends TestCase
{
    use RefreshDatabase;

    private $p1;
    private $p2;
    private $lama;
    private $baru;
    private $akun;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
        \Illuminate\Support\Carbon::setTestNow('2027-06-01'); // periode 2027-2029 harus aktif
        $this->p1 = Periode::firstOrCreate(['tahun_mulai' => 2024, 'tahun_selesai' => 2026]);
        $this->p2 = Periode::firstOrCreate(['tahun_mulai' => 2027, 'tahun_selesai' => 2029]);
        $this->lama = Bidang::create(['nama_bidang' => 'Lama', 'foto_bidang' => 'a.jpg', 'periode_id' => $this->p1->id]);
        $this->baru = Bidang::create(['nama_bidang' => 'Baru', 'foto_bidang' => 'b.jpg', 'periode_id' => $this->p2->id]);
        $this->akun = User::factory()->admin($this->p2)->create();
    }

    protected function tearDown(): void
    {
        \Illuminate\Support\Carbon::setTestNow();
        parent::tearDown();
    }

    public function test_admin_periode_hanya_melihat_bidang_periodenya()
    {
        $this->actingAs($this->akun)->get(route('bidang.index'))
            ->assertOk()->assertSee('Baru')->assertDontSee('Lama');
    }

    public function test_edit_data_periode_lain_404()
    {
        $this->actingAs($this->akun)->get(route('bidang.edit', $this->lama->id))->assertNotFound();
        $this->actingAs($this->akun)->delete(route('bidang.destroy', $this->lama->id))->assertNotFound();
        $this->assertDatabaseHas('bidangs', ['id' => $this->lama->id]);
    }

    public function test_data_baru_otomatis_masuk_periode_akun()
    {
        $this->actingAs($this->akun)->post(route('jabatan.store'), ['nama_jabatan' => 'Ketua']);
        $this->assertDatabaseHas('jabatan_bidangs', ['nama_jabatan' => 'Ketua', 'periode_id' => $this->p2->id]);
    }

    public function test_api_ikut_terisolasi()
    {
        $this->artisan('passport:keys'); // kunci OAuth (gitignored) dibuat bila belum ada
        Passport::actingAs($this->akun, [], 'api');
        $this->getJson('/api/bidang')->assertOk()->assertSee('Baru')->assertDontSee('Lama');
    }

    public function test_publik_tidak_difilter()
    {
        $this->assertSame(2, Bidang::count());
    }

    public function test_kegiatan_checked_butuh_login()
    {
        $this->delete(route('checked-activity'))->assertRedirect(route('login'));
    }
}
