<?php

namespace Tests\Feature;

use App\Models\ActivityLog;
use App\Models\Inventaris;
use App\Models\Periode;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class LogAktivitasTest extends TestCase
{
    use RefreshDatabase;

    private $p1;
    private $p2;
    private $akun1;
    private $akun2;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
        Carbon::setTestNow('2026-06-01');
        $this->p1 = Periode::firstOrCreate(['tahun_mulai' => 2024, 'tahun_selesai' => 2026]);
        $this->p2 = Periode::firstOrCreate(['tahun_mulai' => 2026, 'tahun_selesai' => 2028]);
        $this->akun1 = User::factory()->admin($this->p1)->create();
        $this->akun2 = User::factory()->admin($this->p2)->create();
    }

    protected function tearDown(): void
    {
        Carbon::setTestNow();
        parent::tearDown();
    }

    private function barang(array $o = [])
    {
        $jenis = \App\Models\JenisInventaris::firstOrCreate(['nama' => 'Furnitur']);

        return Inventaris::create($o + ['jenis_id' => $jenis->id, 'nama' => 'Kursi', 'kode' => 'K1', 'jumlah' => 3, 'keterangan' => 'Baik', 'photo' => 'inventaris/lama.jpg']);
    }

    public function test_ubah_inventaris_tercatat_hanya_field_berubah()
    {
        $b = $this->barang();
        ActivityLog::query()->delete();

        $this->actingAs($this->akun1)->put(route('inventaris.update', $b->id), [
            'nama' => 'Kursi', 'kode' => 'K1', 'jumlah' => 2, 'keterangan' => 'Baik',
        ]);

        $log = ActivityLog::where('aksi', 'ubah')->firstOrFail();
        $this->assertEquals(['jumlah' => 3], $log->sebelum);
        $this->assertEquals(['jumlah' => 2], $log->sesudah);
        $this->assertSame($this->akun1->id, $log->user_id);
        $this->assertSame($this->p1->id, $log->periode_id);
    }

    public function test_hapus_menyimpan_salinan_lengkap()
    {
        $b = $this->barang(['nama' => 'Meja']);
        Storage::fake('public');

        $this->actingAs($this->akun1)->delete(route('inventaris.destroy', $b->id));

        $this->assertDatabaseMissing('inventaris', ['id' => $b->id]);
        $this->assertSame('Meja', ActivityLog::where('aksi', 'hapus')->firstOrFail()->sebelum['nama']);
    }

    public function test_log_menyimpan_nilai_mentah()
    {
        Storage::fake('public');
        $b = $this->barang();
        $mentah = Inventaris::find($b->id)->getRawOriginal('photo'); // nilai di DB, bukan hasil cast

        $this->actingAs($this->akun1)->put(route('inventaris.update', $b->id), [
            'nama' => 'Kursi', 'kode' => 'K1', 'jumlah' => 3, 'keterangan' => 'Baik',
            'photo' => UploadedFile::fake()->image('baru.jpg'),
        ]);

        $log = ActivityLog::where('aksi', 'ubah')->firstOrFail();
        $this->assertSame($mentah, $log->sebelum['photo']);
        $this->assertStringStartsNotWith('http', $log->sebelum['photo']);
        $this->assertStringStartsNotWith('http', $log->sesudah['photo']);
    }

    public function test_password_tidak_dicatat()
    {
        $this->akun1->update(['password' => bcrypt('baru-123'), 'name' => 'Nama Baru']);
        User::factory()->create(['password' => 'x']);

        $this->assertGreaterThan(0, ActivityLog::count());
        foreach (ActivityLog::all() as $log) {
            $this->assertArrayNotHasKey('password', $log->sebelum ?? []);
            $this->assertArrayNotHasKey('password', $log->sesudah ?? []);
            $this->assertArrayNotHasKey('remember_token', $log->sesudah ?? []);
        }
    }

    public function test_inventaris_baru_mencatat_periode_masuk()
    {
        Storage::fake('public');
        $this->actingAs($this->akun2)->post(route('inventaris.store'), [
            'nama' => 'Lemari', 'jenis_id' => \App\Models\JenisInventaris::firstOrCreate(['nama' => 'Furnitur'])->id, 'kode' => 'L1', 'jumlah' => 1, 'keterangan' => 'Baik',
            'photo' => UploadedFile::fake()->image('l.jpg'),
        ]);

        $b = Inventaris::where('nama', 'Lemari')->firstOrFail();
        $this->assertSame($this->p2->id, $b->periode_id);
        $this->actingAs($this->akun1)->get(route('inventaris.index'))->assertSee('Lemari')->assertSee('2026-2028');
    }

    public function test_visibilitas_log()
    {
        $this->actingAs($this->akun1);
        $this->app->instance("request", \Illuminate\Http\Request::create("/admin/dashboard"));
        $this->barang();
        \App\Models\Bidang::create(['nama_bidang' => 'B1', 'foto_bidang' => 'a.jpg']);

        $lihat = ActivityLog::terlihatOleh($this->akun2)->pluck('model')->all();
        $this->assertContains(Inventaris::class, $lihat);
        $this->assertNotContains(\App\Models\Bidang::class, $lihat);
        $this->assertContains(\App\Models\Bidang::class, ActivityLog::terlihatOleh($this->akun1)->pluck('model')->all());
    }
}
