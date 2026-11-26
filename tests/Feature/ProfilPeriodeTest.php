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
        $this->assertSame('Periode 2018 - 2020', $this->profil->periode);
        $this->get(route('profil'))->assertOk()->assertSee('Periode 2018 - 2020');
    }

    public function test_migrasi_membaca_format_periode_lama()
    {
        $this->artisan('migrate:rollback', ['--step' => 1]);
        $this->assertSame('Periode 2018 - 2020', \DB::table('profils')->value('periode'));
        \DB::table('profils')->insert([
            ['periode' => 'Periode 2013 - 2015', 'content' => 'a', 'photo' => 'x'],
            ['periode' => 'Periode 2016 - 2018', 'content' => 'b', 'photo' => 'x'],
            ['periode' => 'aneh', 'content' => 'c', 'photo' => 'x'],
        ]);
        $this->artisan('migrate');

        $label = fn ($c) => Profil::where('content', $c)->first()->periode;
        $this->assertSame('Periode 2013 - 2015', $label('a'));
        $this->assertSame('Periode 2016 - 2018', $label('b'));
        $this->assertSame('Periode 2024 - 2026', $label('c'));
        $this->assertSame('Periode 2018 - 2020', $this->profil->fresh()->periode);
    }

    public function test_log_tidak_memuat_kunci_periode()
    {
        $this->profil->update(['content' => 'z']);
        $log = ActivityLog::where('model_id', $this->profil->id)->where('aksi', 'ubah')->first();
        $this->assertArrayNotHasKey('periode', $log->sesudah);
    }
}
