<?php

namespace Tests\Feature;

use App\Models\AnggotaBidang;
use App\Models\Bidang;
use App\Models\JabatanBidang;
use App\Models\Periode;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class PeriodeDetailTest extends TestCase
{
    use RefreshDatabase;

    private Periode $p1;
    private Periode $p2;

    protected function setUp(): void
    {
        parent::setUp();
        Carbon::setTestNow('2026-06-01');
        $this->withoutVite();
        $this->p1 = Periode::firstOrCreate(['tahun_mulai' => 2024, 'tahun_selesai' => 2026]);
        $this->p2 = Periode::firstOrCreate(['tahun_mulai' => 2026, 'tahun_selesai' => 2028]);
        foreach ([[$this->p1, 'Lama'], [$this->p2, 'Baru']] as [$p, $n]) {
            $b = Bidang::forceCreate(['nama_bidang' => "Bidang $n", 'foto_bidang' => 'x.jpg', 'periode_id' => $p->id]);
            $j = JabatanBidang::forceCreate(['nama_jabatan' => "Ketua $n", 'periode_id' => $p->id]);
            AnggotaBidang::forceCreate(['nama_anggota' => "Pengurus $n", 'foto' => 'x.jpg',
                'jabatans_id' => $j->id, 'bidangs_id' => $b->id, 'periode_id' => $p->id]);
        }
    }

    protected function tearDown(): void
    {
        Carbon::setTestNow();
        parent::tearDown();
    }

    public function test_admin_utama_melihat_data_per_periode_beserta_relasinya()
    {
        // Periode lama tetap terbuka lengkap walau periode default admin utama adalah yang terbaru.
        $this->actingAs(User::factory()->admin(null)->create())
            ->get(route('periode.show', $this->p1))
            ->assertOk()->assertSee('Pengurus Lama')->assertSee('Ketua Lama')->assertSee('Bidang Lama')
            ->assertDontSee('Pengurus Baru');

        $this->get(route('periode.show', [$this->p2, 'tab' => 'bidang']))
            ->assertOk()->assertSee('Bidang Baru')->assertDontSee('Bidang Lama');
    }

    public function test_tab_tidak_dikenal_kembali_ke_pengurus()
    {
        $this->actingAs(User::factory()->admin(null)->create())
            ->get(route('periode.show', [$this->p1, 'tab' => 'users']))->assertOk()->assertSee('Pengurus Lama');
    }

    public function test_admin_periode_tidak_bisa_membuka_detail_periode()
    {
        $this->actingAs(User::factory()->admin($this->p1)->create())
            ->get(route('periode.show', $this->p2))->assertForbidden();
    }
}
