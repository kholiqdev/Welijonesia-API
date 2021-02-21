<?php

namespace App\Http\Controllers\Customer\Auth;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\Auth\LoginRequest;
use Illuminate\Database\QueryException;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  LoginRequest  $request
     * @return json
     */
    public function __invoke(LoginRequest $request)
    {
        try {
            if ($token = JWTAuth::attempt($request->validated())) {
                if (JWTAuth::user()->role == 'customer') return ResponseFormatter::success(['token' => $token, 'user' => auth()->user()], 'Berhasil Login');
            }

            return ResponseFormatter::error('Login Gagal', 400);
        } catch (QueryException $e) {
            return ResponseFormatter::error($e->getMessage(), 400);
        }
    }
}
