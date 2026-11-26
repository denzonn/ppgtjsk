<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/** Admin utama hanya melihat data; yang boleh diubah hanya periode dan akun. */
class HanyaLihat
{
    const BOLEH = ['periode.*', 'akun.*'];

    const PESAN = 'Admin utama hanya bisa melihat data.';

    public function handle(Request $request, Closure $next)
    {
        $ubah = ! $request->isMethodSafe() || Str::endsWith((string) $request->route()?->getName(), ['.create', '.edit']);

        if (! $ubah || ! $request->user()?->isAdminUtama() || $request->routeIs(self::BOLEH)) {
            return $next($request);
        }

        if ($request->expectsJson() || $request->is('api/*')) {
            return response()->json(['success' => false, 'message' => self::PESAN], 403);
        }

        return redirect()->back(302, [], route('dashboard'))->with('error', self::PESAN);
    }
}
