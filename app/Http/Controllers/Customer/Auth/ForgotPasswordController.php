<?php

namespace App\Http\Controllers\Customer\Auth;

use App\Events\UserForgotPassword;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\Auth\ForgotPasswordRequest;
use App\Models\User;
use App\Models\Verification;
use Illuminate\Database\QueryException;

class ForgotPasswordController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  ForgotPasswordRequest  $request
     * @return json
     */
    public function __invoke(ForgotPasswordRequest $request)
    {
        try {
            $user = User::where($request->validated())->first();
            if ($user) {
                Verification::create([
                    'user_id' => $user->id,
                    'code' => rand(0000, 9999),
                    'via' => 'email',
                ]);

                // SendEmailActivation::dispatch($user);
                event(new UserForgotPassword($user));

                return ResponseFormatter::success(['user' => $user->makeHidden('verifications')], 'Kode Verifikasi Telah Kami Kirim ke Email Anda!');
            }
        } catch (QueryException $e) {
            return ResponseFormatter::error($e->getMessage(), 400);
        }
    }
}
