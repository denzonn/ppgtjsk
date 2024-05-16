@extends('layouts.admin')

@section('title')
    Admin Data Anggota
@endsection

@section('content')
    <div class="pages">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('data-anggota.index') }}" class="back">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <span class="title">Data Anggota</span>
            </div>
            <div class="card-body dataAnggota">
                <div>
                    <div class="row">
                        <div class="col-2">
                            <div>Nik</div>
                        </div>
                        <div class="col-10">: {{ $data->nik }}</div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <div>Nama</div>
                        </div>
                        <div class="col-10">: {{ $data->nama }}</div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <div>Email</div>
                        </div>
                        <div class="col-10">: {{ $data->email }}</div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <div>No HP</div>
                        </div>
                        <div class="col-10">: {{ $data->no_hp }}</div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <div>Tempat, Tanggal Lahir</div>
                        </div>
                        <div class="col-10">: {{ $data->tempat_lahir }}, {{ \Carbon\Carbon::parse($data->tanggal_lahir)->locale('id')->isoFormat(' D MMMM YYYY') }}</div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <div>Jenis Kelamin</div>
                        </div>
                        <div class="col-10">: {{ $data->jenis_kelamin }}</div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <div>Golongan Darah / Rhesus</div>
                        </div>
                        <div class="col-10">: {{ $data->golongan_darah }} / {{ $data->rhesus }}</div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <div>Bersedia Mendonor</div>
                        </div>
                        <div class="col-10">: {{ $data->bersedia }}</div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <div>Status / Keanggotaan</div>
                        </div>
                        <div class="col-10">: {{ $data->status }} / {{ $data->keanggotaan }}</div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <div>Pendidikan / Pekerjaan</div>
                        </div>
                        <div class="col-10">: {{ $data->pendidikan }} / {{ $data->pekerjaan }}</div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <div>Domisili</div>
                        </div>
                        <div class="col-10">: {{ $data->domisili }}</div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <div>Nama Ayah / Ibu</div>
                        </div>
                        <div class="col-10">: {{ $data->nama_ayah }} / {{ $data->nama_ibu }}</div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <div>Keterangan Tinggal / Wilayah Pelayanan</div>
                        </div>
                        <div class="col-10">: {{ $data->keterangan_tinggal }} / Wilayah Pelayanan {{ $data->wilayah }}</div>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="{{ route('data-anggota.accData', $data->id) }}"
                        class="btn btn-sm btn-primary px-4 py-1" style="font-size: 16px">Approve</a>
                    <form action="{{ route('data-anggota.destroy', $data->id) }}" method="POST"
                        class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger px-4 py-1" style="font-size: 16px">Tolak</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

