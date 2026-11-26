<?php

namespace App\Http\Controllers\Admin;

use App\Casts\PublicUrl;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\ProgramKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kegiatan = Kegiatan::all();

        return view('pages.admin.kegiatan.index', [
            'kegiatan' => $kegiatan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $program = ProgramKerja::all();

    return  view('pages.admin.kegiatan.create', [
            'program' => $program
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $this->validate($request, [
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:3072',
        ]);

        $data['slug'] = \Str::slug($request->name);

        if ($request->hasFile('photo')) {
            $images = $request->file('photo');

            $extension = $images->getClientOriginalExtension();

            $file_name = "kegiatan-" . $data['name'] . "." . $extension;

            $data['photo'] = $images->storeAs('photo', $file_name, 'public');
        }
        $data['bidang_id'] = ProgramKerja::findOrFail($request->program_id)->bidang_id;
        $data['checked'] = false;

        if (!is_null($data['link_drive'][0])) {
            $linkDrive = json_encode($data['link_drive']);
        } else {
            $linkDrive = null;
        }

        // Hapus data link_drive dari array $data
        unset($data['link_drive']);

        Kegiatan::create([
            'link_drive' => $linkDrive,
            ...$data
        ]);

        return redirect()->route('kegiatan.index');
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
        $kegiatan = Kegiatan::findOrFail($id);
        $program = ProgramKerja::all()->except($kegiatan->program_id);
        $linkDrive = json_decode($kegiatan->link_drive);

        return view('pages.admin.kegiatan.edit', [
            'kegiatan' => $kegiatan,
            'program' => $program,
            'linkDrive' => $linkDrive
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
        $data = $request->all();

        $data['slug'] = \Str::slug($request->name);
        $kegiatan = Kegiatan::findOrFail($id);

        if ($request->hasFile('photo')) {
            if($kegiatan->photo){
                Storage::disk('public')->delete(PublicUrl::toPath($kegiatan->getRawOriginal('photo')));
            }

            $images = $request->file('photo');

            $extension = $images->getClientOriginalExtension();

            $file_name = "kegiatan-" . $data['name'] . "." . $extension;

            $data['photo'] = $images->storeAs('photo', $file_name, 'public');
        } else {
            unset($data['photo']);
        }

        $data['bidang_id'] = ProgramKerja::findOrFail($request->program_id)->bidang_id;

        if (!is_null($data['link_drive'][0])) {
            $linkDrive = json_encode($data['link_drive']);
        } else {
            $linkDrive = null;
        }

        // Hapus data link_drive dari array $data
        unset($data['link_drive']);

        $kegiatan->update(array_merge($data, ['link_drive' => $linkDrive]));

        return redirect()->route('kegiatan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Kegiatan::findOrFail($id)->delete();

        return redirect()->route('kegiatan.index');
    }

    public function checkedActivity(Request $request)
    {
        $selectedIdsString = $request->input('selectedIdsToDelete');
        $selectedIdsArray = explode(',', $selectedIdsString);

        $uncheckedKegiatan = Kegiatan::whereNotIn('id', $selectedIdsArray)->get();
        foreach ($uncheckedKegiatan as $kegiatan) {
            $kegiatan->checked = false;
            $kegiatan->save();
        }

        $checkedKegiatan = Kegiatan::whereIn('id', $selectedIdsArray)->get();
        foreach ($checkedKegiatan as $kegiatan) {
            $kegiatan->checked = true;
            $kegiatan->save();
        }

        return redirect()->back()->with('success', 'Status kegiatan berhasil diperbarui.');
    }

}
