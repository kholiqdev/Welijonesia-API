<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use Tymon\JWTAuth\Facades\JWTAuth;

class RefreshController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        return ResponseFormatter::success(['token' => JWTAuth::refresh(), 'user' => auth()->user()], 'Token Diperbarui');
    }
}
