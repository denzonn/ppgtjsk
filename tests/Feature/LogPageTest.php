<?php

namespace Tests\Feature;

use App\Models\ActivityLog;
use App\Models\Bidang;
use App\Models\Inventaris;
use App\Models\Periode;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class LogPageTest extends TestCase
{
    use RefreshDatabase;

    private $p1;
    private $p2;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
        Carbon::setTestNow('2026-06-01');
        $this->p1 = Periode::firstOrCreate(['tahun_mulai' => 2024, 'tahun_selesai' => 2026]);
        $this->p2 = Periode::firstOrCreate(['tahun_mulai' => 2026, 'tahun_selesai' => 2028]);
    }

    protected function tearDown(): void
    {
        Carbon::setTestNow();
        parent::tearDown();
    }

    private function log($model, $periode, $sesudah)
    {
        return ActivityLog::create(['periode_id' => $periode->id, 'per_periode' => true, 'aksi' => 'tambah',
            'model' => $model, 'model_id' => 1, 'sesudah' => $sesudah]);
    }

    public function test_log_page_tampil_dan_terfilter()
    {
        $this->log(Inventaris::class, $this->p1, ['nama' => 'KursiUnik']);
        $this->log(Bidang::class, $this->p1, ['nama' => 'BidangUnik']);
        $a = User::factory()->admin($this->p1)->create();

        $this->actingAs($a)->get(route('log.index'))
            ->assertOk()->assertSee('KursiUnik')->assertSee('BidangUnik');
        $this->actingAs($a)->get(route('log.index', ['model' => Inventaris::class]))
            ->assertSee('KursiUnik')->assertDontSee('BidangUnik');

        $b = User::factory()->admin($this->p2)->create();
        $this->actingAs($b)->get(route('log.index'))
            ->assertDontSee('KursiUnik');
    }

    public function test_navbar_admin_utama_punya_pemilih_periode()
    {
        $this->actingAs(User::factory()->admin(null)->create())->get(route('dashboard'))
            ->assertSee('name="periode_id"', false);
        $this->actingAs(User::factory()->admin($this->p1)->create())->get(route('dashboard'))
            ->assertDontSee('name="periode_id"', false);
    }
}
