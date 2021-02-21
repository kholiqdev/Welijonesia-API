<?php

namespace App\Http\Controllers\Customer\Auth;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\Auth\ResetPasswordRequest;
use App\Models\User;
use App\Models\Verification;
use Illuminate\Database\QueryException;
use Tymon\JWTAuth\Facades\JWTAuth;

class ResetPassword extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  ResetPasswordRequest  $request
     * @return json
     */
    public function __invoke(ResetPasswordRequest $request)
    {
        $user = User::whereHas('verifications', function ($query) use ($request) {
            $query->where('code', $request->code)->where('expired_at', '>', now());
        })->first();

        if ($user) {
            try {
                Verification::where('user_id', $user->id)->delete();

                $token = JWTAuth::fromUser($user);

                return ResponseFormatter::success(['token' => $token, 'user' => $user], 'Verifikasi berhasil, silahkan atur ulang kata sandi anda!');
            } catch (QueryException $e) {
                return ResponseFormatter::error($e->getMessage(), 400);
            }
        }

        return ResponseFormatter::error('Verifikasi gagal, silahkan lakukan kirim ulang permintaan anda!', 400);
    }
}
