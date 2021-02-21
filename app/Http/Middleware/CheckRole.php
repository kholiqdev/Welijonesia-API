<?php

namespace App\Http\Middleware;

use App\Helpers\ResponseFormatter;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param String $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!auth()->user()->role == $role) {
            return ResponseFormatter::error('Anda tidak memiliki hak akses untuk melakukan permintaan ini!', Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
