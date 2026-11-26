<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Periode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AkunController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $akun = User::with('periode')->where('role', 'ADMIN')->whereNotNull('periode_id')
            ->when(! $user->isAdminUtama(), fn ($q) => $q->where('periode_id', $user->periode_id))
            ->orderBy('name')->get()->groupBy('periode_id');
        $periode = Periode::orderByDesc('tahun_mulai')->get()->keyBy('id');

        return view('pages.admin.akun.index', compact('akun', 'periode'));
    }

    public function create()
    {
        $user = auth()->user();
        $periode = Periode::orderByDesc('tahun_mulai')->get()->filter(fn ($p) => $user->bolehBuatAkunDi($p));

        return view('pages.admin.akun.create', compact('periode'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'periode_id' => 'required|exists:periodes,id',
        ]);
        $user = auth()->user();
        $periode = Periode::findOrFail($data['periode_id']);
        if (! $user->bolehBuatAkunDi($periode)) {
            abort_unless($periode->tahun_mulai === $user->periode?->tahun_selesai, 403);
            throw ValidationException::withMessages(['periode_id' => 'Akun serah terima untuk periode ini sudah dibuat.']);
        }
        $baru = new User(['name' => $data['name'], 'email' => $data['email'],
            'password' => Hash::make($data['password']), 'periode_id' => $periode->id, 'dibuat_oleh' => $user->id]);
        $baru->role = 'ADMIN';
        $baru->save();

        return redirect()->route('akun.index')->with('success', 'Akun berhasil ditambahkan.');
    }

    public function destroy(User $akun)
    {
        if ($akun->id === auth()->id()) {
            return back()->with('error', 'Tidak bisa menghapus akun sendiri.');
        }
        abort_unless(auth()->user()->bolehKelolaAkun($akun), 403);
        $akun->delete();

        return back()->with('success', 'Akun berhasil dihapus.');
    }
}
