<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class DesktopTokenAuth
{
    public function handle($request, Closure $next)
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['success' => false, 'message' => 'Token bulunamadı.'], 401);
        }

        $kayit = DB::table('desktop_tokens')->where('token', $token)->first();

        if (!$kayit) {
            return response()->json(['success' => false, 'message' => 'Gecersiz token.'], 401);
        }

        DB::table('desktop_tokens')->where('token', $token)->update(['last_used_at' => now()]);

        return $next($request);
    }
}