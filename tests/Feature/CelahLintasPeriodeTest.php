<?php

namespace Tests\Feature;

use App\Models\ActivityLog;
use App\Models\Bidang;
use App\Models\JabatanBidang;
use App\Models\Kegiatan;
use App\Models\Periode;
use App\Models\ProgramKerja;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;
use Laravel\Passport\Passport;
use Tests\TestCase;

class CelahLintasPeriodeTest extends TestCase
{
    use RefreshDatabase;

    private $p1;
    private $p2;
    private $akun;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
        Carbon::setTestNow('2027-06-01');
        $this->p1 = Periode::firstOrCreate(['tahun_mulai' => 2024, 'tahun_selesai' => 2026]);
        $this->p2 = Periode::firstOrCreate(['tahun_mulai' => 2027, 'tahun_selesai' => 2029]);
        $this->akun = User::factory()->admin($this->p2)->create();
    }

    protected function tearDown(): void
    {
        Carbon::setTestNow();
        parent::tearDown();
    }

    private function api()
    {
        $this->artisan('passport:keys');
        Passport::actingAs($this->akun, [], 'api');
    }

    private function bidangSendiri(): Bidang
    {
        $this->actingAs($this->akun);
        $this->app->instance('request', Request::create('/admin/x'));

        return Bidang::create(['nama_bidang' => 'Sendiri', 'foto_bidang' => 'a.jpg']);
    }

    public function test_periode_id_dari_request_diabaikan_saat_tambah_dan_ubah()
    {
        $this->actingAs($this->akun)->post(route('jabatan.store'), ['nama_jabatan' => 'Siluman', 'periode_id' => $this->p1->id]);
        $this->assertDatabaseHas('jabatan_bidangs', ['nama_jabatan' => 'Siluman', 'periode_id' => $this->p2->id]);

        $b = $this->bidangSendiri();
        $this->actingAs($this->akun)->put(route('bidang.update', $b->id), ['nama_bidang' => 'Milik2', 'periode_id' => $this->p1->id]);
        $this->assertDatabaseHas('bidangs', ['id' => $b->id, 'nama_bidang' => 'Milik2', 'periode_id' => $this->p2->id]);
    }

    public function test_api_periode_id_diabaikan()
    {
        $this->api();
        $this->post('/api/bidang', [
            'nama_bidang' => 'Api', 'periode_id' => $this->p1->id,
            'foto_bidang' => UploadedFile::fake()->image('a.jpg'),
        ], ['Accept' => 'application/json'])->assertOk();
        $this->assertDatabaseHas('bidangs', ['nama_bidang' => 'Api', 'periode_id' => $this->p2->id]);
    }

    public function test_api_ditolak_untuk_non_admin()
    {
        Passport::actingAs(User::factory()->create(['role' => 'USER']), [], 'api');
        $this->getJson('/api/bidang')->assertStatus(403)
            ->assertExactJson(['success' => false, 'message' => 'Hanya admin yang bisa mengakses.']);
    }

    public function test_program_kerja_bidang_periode_lain_ditolak()
    {
        $lain = Bidang::withoutGlobalScope('periode')->create(['nama_bidang' => 'Lain', 'foto_bidang' => 'a.jpg', 'periode_id' => $this->p1->id]);
        $d = ['name' => 'X', 'description' => 'y', 'bidang_id' => $lain->id];
        $this->actingAs($this->akun)->post(route('program-kerja.store'), $d)->assertSessionHasErrors('bidang_id');

        $sendiri = $this->bidangSendiri();
        $pk = ProgramKerja::create(['name' => 'P', 'description' => 'y', 'bidang_id' => $sendiri->id]);
        $this->actingAs($this->akun)->put(route('program-kerja.update', $pk->id), $d)->assertSessionHasErrors('bidang_id');

        $this->api();
        $this->postJson('/api/program-kerja', $d)->assertStatus(422);
        $this->putJson('/api/program-kerja/'.$pk->id, $d)->assertStatus(422);
    }

    public function test_pengurus_jabatan_periode_lain_ditolak()
    {
        $j = JabatanBidang::withoutGlobalScope('periode')->create(['nama_jabatan' => 'Lain', 'periode_id' => $this->p1->id]);
        $b = $this->bidangSendiri();
        $d = fn () => ['nama_anggota' => 'Ani', 'jabatans_id' => $j->id, 'bidangs_id' => $b->id,
            'foto' => UploadedFile::fake()->image('a.jpg')];
        $this->actingAs($this->akun)->post(route('pengurus.store'), $d())->assertSessionHasErrors('jabatans_id');

        $this->api();
        $this->post('/api/pengurus', $d(), ['Accept' => 'application/json'])->assertStatus(422);
    }

    public function test_gallery_kegiatan_periode_lain_ditolak()
    {
        $b = Bidang::withoutGlobalScope('periode')->create(['nama_bidang' => 'Lain', 'foto_bidang' => 'a.jpg', 'periode_id' => $this->p1->id]);
        $pk = ProgramKerja::withoutGlobalScope('periode')->forceCreate(['name' => 'P', 'description' => 'y', 'bidang_id' => $b->id, 'periode_id' => $this->p1->id]);
        $k = Kegiatan::withoutGlobalScope('periode')->forceCreate(['name' => 'Lain', 'slug' => 'lain', 'program_id' => $pk->id, 'bidang_id' => $b->id, 'checked' => 0, 'periode_id' => $this->p1->id, 'description' => 'x', 'photo' => 'a.jpg']);
        $d = fn () => ['kegiatan_id' => $k->id, 'photo' => [UploadedFile::fake()->image('a.jpg')]];
        $this->actingAs($this->akun)->post(route('gallery-kegiatan.store'), $d())->assertSessionHasErrors('kegiatan_id');

        $this->api();
        $this->post('/api/gallery', $d(), ['Accept' => 'application/json'])->assertStatus(422);
    }

    public function test_admin_di_situs_publik_tidak_terfilter()
    {
        $this->bidangSendiri();
        Bidang::withoutGlobalScope('periode')->create(['nama_bidang' => 'Dua', 'foto_bidang' => 'a.jpg', 'periode_id' => $this->p1->id]);
        $this->app->instance('request', Request::create('/'));
        $this->assertNull(Periode::aktif());
        $this->assertSame(2, Bidang::count());
    }

    public function test_admin_periode_maksimal_lima_tahun()
    {
        $this->actingAs($this->akun)->post(route('periode.store'), ['tahun_mulai' => 2029, 'tahun_selesai' => 2035])
            ->assertSessionHasErrors('tahun_selesai');
        $this->assertDatabaseMissing('periodes', ['tahun_mulai' => 2029]);
        $this->actingAs($this->akun)->post(route('periode.store'), ['tahun_mulai' => 2029, 'tahun_selesai' => 2034]);
        $this->assertDatabaseHas('periodes', ['tahun_mulai' => 2029, 'tahun_selesai' => 2034]);
    }

    public function test_api_bidang_validasi_maksimal_orang()
    {
        $this->api();
        $this->postJson('/api/bidang', ['nama_bidang' => 'x', 'maksimal_orang' => 0])->assertStatus(422);
        $b = $this->bidangSendiri();
        $this->putJson('/api/bidang/'.$b->id, ['maksimal_orang' => 'abc'])->assertStatus(422);
    }

    public function test_label_periode_dan_log_akun_per_periode()
    {
        $this->assertSame('Periode', ActivityLog::LABEL[Periode::class]);

        $u1 = User::factory()->admin($this->p1)->create();
        $log = ActivityLog::where('model', User::class)->where('model_id', $u1->id)->first();
        $this->assertSame($this->p1->id, $log->periode_id);
        $this->assertTrue($log->per_periode);
        $this->assertFalse(ActivityLog::terlihatOleh($this->akun)->where('id', $log->id)->exists());
    }
}
