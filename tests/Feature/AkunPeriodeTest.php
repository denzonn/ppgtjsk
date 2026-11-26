<?php

namespace Tests\Feature;

use App\Models\Periode;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class AkunPeriodeTest extends TestCase
{
    use RefreshDatabase;

    private $p1;
    private $p2;
    private $a1;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
        Carbon::setTestNow('2026-06-01');
        $this->p1 = Periode::firstOrCreate(['tahun_mulai' => 2024, 'tahun_selesai' => 2026]);
        $this->p2 = Periode::firstOrCreate(['tahun_mulai' => 2026, 'tahun_selesai' => 2028]);
        $this->a1 = User::factory()->admin($this->p1)->create();
    }

    protected function tearDown(): void
    {
        Carbon::setTestNow();
        parent::tearDown();
    }

    private function data($periode, $email)
    {
        return ['data_anggota_id' => $this->anggota($email)->id, 'password' => 'rahasia123',
            'password_confirmation' => 'rahasia123', 'periode_id' => $periode->id];
    }

    public function test_akun_diambil_dari_data_anggota()
    {
        $anggota = $this->anggota('budi@x.com');
        $this->actingAs($this->a1)->post(route('akun.store'), ['data_anggota_id' => $anggota->id,
            'password' => 'rahasia123', 'password_confirmation' => 'rahasia123', 'periode_id' => $this->p1->id])
            ->assertSessionHasNoErrors();

        $akun = User::where('email', 'budi@x.com')->first();
        $this->assertSame('Anggota budi@x.com', $akun->name);
        $this->assertSame($anggota->id, $akun->data_anggota_id);
    }

    public function test_anggota_belum_acc_atau_sudah_punya_akun_ditolak()
    {
        $belum = $this->anggota('belum@x.com', false);
        $sudah = $this->anggota($this->a1->email);
        foreach ([$belum, $sudah] as $a) {
            $this->actingAs($this->a1)->post(route('akun.store'), ['data_anggota_id' => $a->id,
                'password' => 'rahasia123', 'password_confirmation' => 'rahasia123', 'periode_id' => $this->p1->id])
                ->assertSessionHasErrors('data_anggota_id');
        }
        $this->assertFalse(User::where('email', 'belum@x.com')->exists());
    }

    public function test_form_akun_hanya_menampilkan_anggota_yang_bisa_dipilih()
    {
        $this->anggota('pilih@x.com');
        $this->anggota('belum@x.com', false);
        $this->actingAs($this->a1)->get(route('akun.create'))
            ->assertOk()->assertSee('pilih@x.com')->assertDontSee('belum@x.com');
    }

    public function test_admin_periode_buat_akun_periode_sendiri_berkali_kali()
    {
        $this->actingAs($this->a1)->post(route('akun.store'), $this->data($this->p1, 'a@x.com'))->assertRedirect();
        $this->actingAs($this->a1)->post(route('akun.store'), $this->data($this->p1, 'b@x.com'))->assertRedirect();
        $this->assertSame(2, User::where('periode_id', $this->p1->id)->where('dibuat_oleh', $this->a1->id)->count());
        $this->assertSame('ADMIN', User::where('email', 'a@x.com')->first()->role);
    }

    public function test_serah_terima_hanya_satu_akun()
    {
        $lain = User::factory()->admin($this->p1)->create();
        $this->actingAs($this->a1)->post(route('akun.store'), $this->data($this->p2, 'a@x.com'))->assertRedirect();
        $this->actingAs($lain)->post(route('akun.store'), $this->data($this->p2, 'b@x.com'))
            ->assertSessionHasErrors(['periode_id' => 'Akun serah terima untuk periode ini sudah dibuat.']);
        $this->assertSame(1, User::where('periode_id', $this->p2->id)->count());
    }

    public function test_tidak_bisa_buat_akun_di_periode_lain()
    {
        $p3 = Periode::create(['tahun_mulai' => 2028, 'tahun_selesai' => 2030]);
        $this->actingAs($this->a1)->post(route('akun.store'), $this->data($p3, 'a@x.com'))->assertForbidden();
    }

    public function test_admin_periode_hanya_buat_periode_berikutnya()
    {
        Periode::where('id', $this->p2->id)->delete();
        $this->actingAs($this->a1)->post(route('periode.store'), ['tahun_mulai' => 2026, 'tahun_selesai' => 2028])->assertRedirect();
        $this->assertDatabaseHas('periodes', ['tahun_mulai' => 2026, 'tahun_selesai' => 2028, 'dibuat_oleh' => $this->a1->id]);
        $this->actingAs($this->a1)->post(route('periode.store'), ['tahun_mulai' => 2030, 'tahun_selesai' => 2032])->assertForbidden();
    }

    public function test_admin_utama_pilih_periode()
    {
        $utama = User::factory()->admin()->create();
        $this->actingAs($utama)->post(route('periode.pilih'), ['periode_id' => $this->p2->id])
            ->assertSessionHas('periode_id', $this->p2->id);
        $this->actingAs($this->a1)->post(route('periode.pilih'), ['periode_id' => $this->p2->id])->assertForbidden();
    }

    public function test_tidak_bisa_hapus_diri_sendiri()
    {
        $this->actingAs($this->a1)->delete(route('akun.destroy', $this->a1->id))->assertSessionHas('error');
        $this->assertDatabaseHas('users', ['id' => $this->a1->id]);
    }

    public function test_halaman_dapat_dibuka()
    {
        $this->actingAs($this->a1)->get(route('periode.index'))->assertOk();
        $this->actingAs($this->a1)->get(route('periode.create'))->assertOk();
        $this->actingAs($this->a1)->get(route('akun.index'))->assertOk();
        $this->actingAs($this->a1)->get(route('akun.create'))->assertOk();
    }

    public function test_admin_periode_tidak_bisa_buat_periode_berikutnya_ganda()
    {
        $this->actingAs($this->a1)->post(route('periode.store'), ['tahun_mulai' => 2026, 'tahun_selesai' => 2030])
            ->assertSessionHasErrors(['tahun_mulai' => 'Periode ini sudah ada.']);
        $this->assertDatabaseMissing('periodes', ['tahun_selesai' => 2030]);
    }

    public function test_hapus_akun_dibatasi()
    {
        $lain = User::factory()->admin($this->p2)->create();
        $this->actingAs($this->a1)->delete(route('akun.destroy', $lain->id))->assertForbidden();
        $utama = User::factory()->admin()->create();
        $this->actingAs($utama)->delete(route('akun.destroy', User::factory()->admin()->create()->id))->assertForbidden();
        $this->assertDatabaseHas('users', ['id' => $lain->id]);
    }
}
