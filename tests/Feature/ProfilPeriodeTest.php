<?php

namespace Tests\Feature;

use App\Models\ActivityLog;
use App\Models\Admin\Profil;
use App\Models\Periode;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class ProfilPeriodeTest extends TestCase
{
    use RefreshDatabase;

    private $lama;
    private $profil;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
        Carbon::setTestNow('2026-06-01');
        $this->lama = Periode::create(['tahun_mulai' => 2018, 'tahun_selesai' => 2020]);
        $this->profil = Profil::create(['periode_id' => $this->lama->id, 'content' => '<p>lama</p>', 'photo' => 'photo/x.jpg']);
    }

    protected function tearDown(): void
    {
        Carbon::setTestNow();
        parent::tearDown();
    }

    public function test_admin_periode_bisa_ubah_profil_periode_lain()
    {
        $p2 = Periode::firstOrCreate(['tahun_mulai' => 2026, 'tahun_selesai' => 2028]);
        $akun = User::factory()->admin($p2)->create();

        $this->actingAs($akun)->put(route('profil-ppgt.update', $this->profil->id), [
            'periode_id' => $this->lama->id,
            'content' => '<p>baru</p>',
        ])->assertRedirect(route('profil-ppgt.index'));

        $this->assertSame('<p>baru</p>', $this->profil->fresh()->content);
        $this->assertTrue(ActivityLog::where('aksi', 'ubah')->where('user_id', $akun->id)
            ->where('model_id', $this->profil->id)->exists());
    }

    public function test_accessor_periode_untuk_halaman_publik()
    {
        $this->assertSame('2018-2020', $this->profil->periode);
        $this->get(route('profil'))->assertOk()->assertSee('2018-2020');
    }
}
