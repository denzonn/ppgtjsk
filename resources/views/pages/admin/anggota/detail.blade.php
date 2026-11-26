@extends('layouts.admin')

@section('title')
    Admin Data Anggota
@endsection

@section('content')
    <div class="mx-auto w-full max-w-5xl">
        <div class="overflow-hidden rounded-xl bg-white border border-admin-border">
            <div class="flex items-center gap-4 border-b border-admin-border bg-ink-50 px-6 py-5 md:px-8">
                <a href="{{ route('data-anggota.index') }}" title="Kembali"
                    class="grid size-10 shrink-0 place-items-center rounded-lg bg-white text-slate-500 border border-admin-border transition hover:text-ink-600"><i class="bx bx-arrow-back text-xl"></i></a>
                <span class="grid size-12 shrink-0 place-items-center rounded-xl bg-ink-500 text-2xl text-white"><i class="bx bx-id-card"></i></span>
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.18em] text-ink-600">Detail data</p>
                    <h1 class="text-xl font-semibold text-admin-heading">Data Anggota</h1>
                </div>
            </div>
            <div class="p-6 md:p-8">
                <div>
                    <div class="-mx-3 flex flex-wrap">
                        <div class="shrink-0 px-3 w-2/12">
                            <div>Nik</div>
                        </div>
                        <div class="shrink-0 px-3 w-10/12">: {{ $data->nik }}</div>
                    </div>
                    <div class="-mx-3 flex flex-wrap">
                        <div class="shrink-0 px-3 w-2/12">
                            <div>Nama</div>
                        </div>
                        <div class="shrink-0 px-3 w-10/12">: {{ $data->nama }}</div>
                    </div>
                    <div class="-mx-3 flex flex-wrap">
                        <div class="shrink-0 px-3 w-2/12">
                            <div>Email</div>
                        </div>
                        <div class="shrink-0 px-3 w-10/12">: {{ $data->email }}</div>
                    </div>
                    <div class="-mx-3 flex flex-wrap">
                        <div class="shrink-0 px-3 w-2/12">
                            <div>No HP</div>
                        </div>
                        <div class="shrink-0 px-3 w-10/12">: {{ $data->no_hp }}</div>
                    </div>
                    <div class="-mx-3 flex flex-wrap">
                        <div class="shrink-0 px-3 w-2/12">
                            <div>Tempat, Tanggal Lahir</div>
                        </div>
                        <div class="shrink-0 px-3 w-10/12">: {{ $data->tempat_lahir }}, {{ \Carbon\Carbon::parse($data->tanggal_lahir)->locale('id')->isoFormat(' D MMMM YYYY') }}</div>
                    </div>
                    <div class="-mx-3 flex flex-wrap">
                        <div class="shrink-0 px-3 w-2/12">
                            <div>Jenis Kelamin</div>
                        </div>
                        <div class="shrink-0 px-3 w-10/12">: {{ $data->jenis_kelamin }}</div>
                    </div>
                    <div class="-mx-3 flex flex-wrap">
                        <div class="shrink-0 px-3 w-2/12">
                            <div>Golongan Darah / Rhesus</div>
                        </div>
                        <div class="shrink-0 px-3 w-10/12">: {{ $data->golongan_darah }} / {{ $data->rhesus }}</div>
                    </div>
                    <div class="-mx-3 flex flex-wrap">
                        <div class="shrink-0 px-3 w-2/12">
                            <div>Bersedia Mendonor</div>
                        </div>
                        <div class="shrink-0 px-3 w-10/12">: {{ $data->bersedia }}</div>
                    </div>
                    <div class="-mx-3 flex flex-wrap">
                        <div class="shrink-0 px-3 w-2/12">
                            <div>Status / Keanggotaan</div>
                        </div>
                        <div class="shrink-0 px-3 w-10/12">: {{ $data->status }} / {{ $data->keanggotaan }}</div>
                    </div>
                    <div class="-mx-3 flex flex-wrap">
                        <div class="shrink-0 px-3 w-2/12">
                            <div>Pendidikan / Pekerjaan</div>
                        </div>
                        <div class="shrink-0 px-3 w-10/12">: {{ $data->pendidikan }} / {{ $data->pekerjaan }}</div>
                    </div>
                    <div class="-mx-3 flex flex-wrap">
                        <div class="shrink-0 px-3 w-2/12">
                            <div>Domisili</div>
                        </div>
                        <div class="shrink-0 px-3 w-10/12">: {{ $data->domisili }}</div>
                    </div>
                    <div class="-mx-3 flex flex-wrap">
                        <div class="shrink-0 px-3 w-2/12">
                            <div>Nama Ayah / Ibu</div>
                        </div>
                        <div class="shrink-0 px-3 w-10/12">: {{ $data->nama_ayah }} / {{ $data->nama_ibu }}</div>
                    </div>
                    <div class="-mx-3 flex flex-wrap">
                        <div class="shrink-0 px-3 w-2/12">
                            <div>Keterangan Tinggal / Wilayah Pelayanan</div>
                        </div>
                        <div class="shrink-0 px-3 w-10/12">: {{ $data->keterangan_tinggal }} / Wilayah Pelayanan {{ $data->wilayah }}</div>
                    </div>
                </div>
                <div class="mt-6">
                    <a href="{{ route('data-anggota.accData', $data->id) }}"
                        class="inline-block rounded-lg text-center font-medium transition px-3.5 py-1 text-xs bg-ink-600 text-white hover:bg-ink-700 px-6! py-1! text-[16px]">Approve</a>
                    <form action="{{ route('data-anggota.destroy', $data->id) }}" method="POST"
                        class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-block rounded-lg text-center font-medium transition px-3.5 py-1 text-xs bg-danger-500 text-white hover:bg-danger-600 px-6! py-1! text-[16px]">Tolak</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

