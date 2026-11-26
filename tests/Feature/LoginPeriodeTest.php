<?php

namespace Tests\Feature;

use App\Models\Periode;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class LoginPeriodeTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
    }

    protected function tearDown(): void
    {
        Carbon::setTestNow();
        parent::tearDown();
    }

    private function periode($a, $b)
    {
        return Periode::firstOrCreate(['tahun_mulai' => $a, 'tahun_selesai' => $b]);
    }

    private function akun(Periode $p = null)
    {
        return User::factory()->admin($p)->create(['password' => bcrypt('rahasia123')]);
    }

    public function test_login_ditolak_periode_lewat()
    {
        Carbon::setTestNow('2026-06-01');
        $u = $this->akun($this->periode(2021, 2023));

        $this->post('/login', ['email' => $u->email, 'password' => 'rahasia123'])
            ->assertSessionHasErrors(['email' => 'Masa periode 2021-2023 sudah berakhir.']);
        $this->assertGuest();
    }

    public function test_login_periode_aktif_berhasil()
    {
        Carbon::setTestNow('2026-06-01');
        $u = $this->akun($this->periode(2024, 2026));

        $this->post('/login', ['email' => $u->email, 'password' => 'rahasia123'])
            ->assertRedirect('/admin/dashboard');
        $this->assertAuthenticatedAs($u);
    }

    public function test_sesi_aktif_diputus_setelah_periode_lewat()
    {
        Carbon::setTestNow('2026-06-01');
        $this->actingAs($this->akun($this->periode(2024, 2026)));
        Carbon::setTestNow('2027-01-02');

        $this->get('/admin/dashboard')->assertRedirect(route('login'));
        $this->assertGuest();
    }

    public function test_api_login_ditolak_periode_lewat()
    {
        Carbon::setTestNow('2026-06-01');
        $u = $this->akun($this->periode(2021, 2023));

        $r = $this->postJson('/api/login', ['email' => $u->email, 'password' => 'rahasia123']);
        $this->assertNotEquals(200, $r->status());
        $this->assertArrayNotHasKey('token', $r->json('data') ?? []);
        $this->assertStringContainsString('Masa periode 2021-2023 sudah berakhir.', $r->getContent());
    }

    public function test_admin_utama_tidak_pernah_diblokir()
    {
        Carbon::setTestNow('2040-01-01');
        $u = $this->akun(null);

        $this->post('/login', ['email' => $u->email, 'password' => 'rahasia123'])
            ->assertRedirect('/admin/dashboard');
        $this->actingAs($u)->get('/admin/dashboard')->assertOk();
    }
}
