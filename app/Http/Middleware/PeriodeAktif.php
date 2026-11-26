<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeriodeAktif
{
    public static function pesan($user): string
    {
        return 'Masa periode '.$user->periode?->label().' sudah berakhir.';
    }

    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if (! $user || $user->role !== 'ADMIN' || $user->bolehMasuk()) {
            return $next($request);
        }

        $pesan = static::pesan($user);

        if ($request->expectsJson() || $request->is('api/*')) {
            $user->token()?->revoke();

            return response()->json(['success' => false, 'message' => $pesan], 403);
        }

        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->withErrors(['email' => $pesan]);
    }
}
