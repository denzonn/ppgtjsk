<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Periode;
use App\Models\User;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index(Request $request)
    {
        $model = array_key_exists((string) $request->model, ActivityLog::LABEL) ? $request->model : null;
        $aksi = in_array($request->aksi, ['tambah', 'ubah', 'hapus'], true) ? $request->aksi : null;

        $logs = ActivityLog::terlihatOleh($request->user())
            ->with(['user', 'periode'])
            ->when($model, fn ($q) => $q->where('model', $model))
            ->when($aksi, fn ($q) => $q->where('aksi', $aksi))
            ->when($request->filled('periode_id'), fn ($q) => $q->where('periode_id', (int) $request->periode_id))
            ->when($request->filled('user_id'), fn ($q) => $q->where('user_id', (int) $request->user_id))
            ->latest('created_at')->latest('id')
            ->paginate(25)->withQueryString();

        return view('pages.admin.log.index', [
            'logs' => $logs,
            'periodes' => Periode::orderByDesc('tahun_mulai')->get(),
            'users' => User::orderBy('name')->get(['id', 'name']),
        ]);
    }
}
