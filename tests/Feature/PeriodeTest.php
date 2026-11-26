<?php

namespace Tests\Feature;

use App\Models\Periode;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class PeriodeTest extends TestCase
{
    use RefreshDatabase;

    private function periode(int $m, int $s): Periode
    {
        return Periode::firstOrCreate(['tahun_mulai' => $m, 'tahun_selesai' => $s]);
    }

    protected function tearDown(): void
    {
        Carbon::setTestNow();
        parent::tearDown();
    }

    public function test_periode_aktif_berdasarkan_tahun()
    {
        Carbon::setTestNow('2026-06-01');
        $this->assertTrue($this->periode(2024, 2026)->isAktif());
        $this->assertFalse($this->periode(2021, 2023)->isAktif());
        $this->assertFalse($this->periode(2027, 2029)->isAktif());
        $this->assertSame('2024-2026', $this->periode(2024, 2026)->label());
        $this->assertSame(2024, $this->periode(2026, 2028)->sebelumnya()->tahun_mulai);
    }

    public function test_dua_periode_aktif_di_tahun_peralihan()
    {
        Carbon::setTestNow('2026-06-01');
        $a = User::factory()->admin($this->periode(2024, 2026))->create();
        $b = User::factory()->admin($this->periode(2026, 2028))->create();
        $this->assertTrue($a->bolehMasuk());
        $this->assertTrue($b->bolehMasuk());

        Carbon::setTestNow('2027-01-01');
        $this->assertFalse($a->fresh()->bolehMasuk());
        $this->assertTrue($b->fresh()->bolehMasuk());
    }

    public function test_aktif_untuk_admin_periode_dan_utama()
    {
        Carbon::setTestNow('2026-06-01');
        $pa = $this->periode(2024, 2026);
        $pb = $this->periode(2026, 2028);
        $a = User::factory()->admin($pa)->create();
        $utama = User::factory()->admin()->create();
        $this->app->instance("request", \Illuminate\Http\Request::create("/admin/dashboard"));

        $this->assertNull(Periode::aktif());

        $this->actingAs($a);
        $this->assertSame($pa->id, Periode::aktif()->id);

        $this->actingAs($utama);
        $this->assertTrue($utama->isAdminUtama());
        $this->assertTrue($utama->bolehMasuk());
        $this->assertSame($pb->id, Periode::aktif()->id);

        $this->withSession(['periode_id' => $pa->id]);
        request()->setLaravelSession(app('session.store'));
        $this->assertSame($pa->id, Periode::aktif()->id);

        $this->actingAs(User::factory()->create(['role' => 'USER']));
        $this->assertNull(Periode::aktif());
    }

    public function test_periode_yang_masih_punya_akun_tidak_bisa_dihapus()
    {
        $p = $this->periode(2030, 2032);
        $u = User::factory()->admin($p)->create();

        try {
            $p->delete();
            $this->fail('Periode terhapus padahal masih punya akun');
        } catch (\Illuminate\Database\QueryException $e) {
            $this->assertSame($p->id, $u->fresh()->periode_id);
        }
    }
}
