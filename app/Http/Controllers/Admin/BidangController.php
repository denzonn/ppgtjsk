<?php

namespace App\Http\Controllers\Admin;

use App\Casts\PublicUrl;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use App\Models\Periode;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BidangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bidang = Bidang::all();

        return view('pages.admin.pengurus.bidang.index', [
            'bidang' => $bidang
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.pengurus.bidang.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validasi 
        $this->validate($request, [
            'foto_bidang' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'maksimal_orang' => 'nullable|integer|min:1',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto_bidang')) {
            $images = $request->file('foto_bidang');

            $extension = $images->getClientOriginalExtension();

            $random = mt_rand(100, 999);

            $file_name = "foto_bidang" . $random . "." . $extension;

            $data['foto_bidang'] = $images->storeAs('foto_bidang', $file_name, 'public');
        }

        Bidang::create($data);

        return redirect()->route('bidang.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bidang = Bidang::findOrFail($id);

        return view('pages.admin.pengurus.bidang.edit', [
            'bidang' => $bidang
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Validasi 
        $this->validate($request, [
            'foto_bidang' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'maksimal_orang' => 'nullable|integer|min:1',
        ]);
        $bidang = Bidang::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('foto_bidang')) {

            if ($bidang->foto_bidang) {
                Storage::disk('public')->delete(PublicUrl::toPath($bidang->getRawOriginal('foto_bidang')));
            }
        
            $images = $request->file('foto_bidang');
        
            $extension = $images->getClientOriginalExtension();
        
            $random = mt_rand(100, 999);
        
            $file_name = "foto_bidang" . $random . "." . $extension;
        
            $data['foto_bidang'] = $images->storeAs('foto_bidang', $file_name, 'public');
        } else {
            unset($data['foto_bidang']);
        }
        

        $bidang->update($data);

        return redirect()->route('bidang.index');
    }

    /** Duplikat file foto supaya menghapus/mengganti foto di satu periode tidak merusak periode lain. */
    private function salinFoto(?string $raw): ?string
    {
        $disk = Storage::disk('public');
        $src = $raw ? PublicUrl::toPath($raw) : null;
        if (! $src || ! $disk->exists($src)) {
            return $raw; // file tidak ada: tidak ada yang bisa disalin, jaga kolom NOT NULL
        }
        $baru = 'foto_bidang/foto_bidang'.uniqid().'.'.pathinfo($src, PATHINFO_EXTENSION);
        $disk->copy($src, $baru);

        return $baru;
    }

    public function salinFormat()
    {
        $aktif = Periode::aktif();
        $sebelumnya = $aktif?->sebelumnya();
        if (! $sebelumnya) {
            return back()->with('error', 'Tidak ada periode sebelumnya untuk disalin.');
        }
        if (Bidang::exists()) {
            return back()->with('error', 'Daftar sudah berisi data, format tidak disalin.');
        }

        DB::transaction(function () use ($aktif, $sebelumnya) {
            Bidang::withoutGlobalScope('periode')->where('periode_id', $sebelumnya->id)->get()->each(
                fn ($b) => Bidang::create([
                    'periode_id' => $aktif->id,
                    'nama_bidang' => $b->nama_bidang,
                    'foto_bidang' => $this->salinFoto($b->getRawOriginal('foto_bidang')),
                    'maksimal_orang' => $b->maksimal_orang,
                ])
            );
        });

        return back()->with('success', 'Format periode sebelumnya berhasil disalin.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Cari data berdasarkan id
        $bidang = Bidang::findOrFail($id);

        Storage::disk('public')->delete(PublicUrl::toPath($bidang->getRawOriginal('foto_bidang')));

        // Hapus data
        $bidang->delete();

        return redirect()->route('bidang.index');
    }
}
