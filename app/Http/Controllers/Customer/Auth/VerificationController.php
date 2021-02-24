<?php

namespace App\Http\Controllers\Customer\Auth;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\Auth\VerificationRequest;
use App\Models\User;
use App\Models\Verification;
use Illuminate\Database\QueryException;

class VerificationController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  VerificationRequest  $request
     * @return json
     */
    public function __invoke(VerificationRequest $request)
    {

        $verification = auth()->user()->verifications->where('expired_at', '>', now())->first();

        if ($verification && $verification->code == $request->code) {
            try {
                auth()->user()->update([
                    'verified_at' => now(),
                    'status' => 1
                ]);

                Verification::where('user_id', auth()->user()->id)->delete();

                return ResponseFormatter::success(auth()->user()->makeHidden('verifications'), 'Selamat, akun anda berhasil diaktivasi!');
            } catch (QueryException $e) {
                return ResponseFormatter::error($e->getMessage(), 400);
            }
        }

        return ResponseFormatter::error('Aktivasi gagal, silahkan lakukan aktivasi ulang!', 400);
    }
}
