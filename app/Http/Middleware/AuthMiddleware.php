<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $token = PersonalAccessToken::findToken($request->bearerToken());
        $expiration = strtotime($token->expires_at);
        if ($expiration <= time()) {
            $token->tokenable->tokens()->delete();
            return response()->json([
                'message' => 'Credenciales expiradas!',
            ]);
        }
        /**
        return response()->json([
            'token' => $request->bearerToken(),
            'headers' => $request->header(),
            'user tokenable' => $token->tokenable,
            'token expires time' => strtotime($token->expires_at),
            'token expires time now' => time(),
            'user santcum' => auth('sanctum')->user()
        ]); */
        return $next($request);
    }
}
