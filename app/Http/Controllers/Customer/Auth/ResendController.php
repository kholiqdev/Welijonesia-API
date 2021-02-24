<?php

namespace App\Http\Controllers\Customer\Auth;

use App\Events\UserRegistered;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\Auth\ResendRequest;
use App\Models\Verification;
use Exception;

class ResendController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  ResendRequest  $request
     * @return json
     */
    public function __invoke(ResendRequest $request)
    {
        try {
            if ($request->via == 'email') {
                $verification = Verification::where('user_id', auth()->user()->id)->where('expired_at', '>', now())->first();

                if ($verification) return ResponseFormatter::error("Hanya dapat mengirim 1x dalam 2 menit, harap tunggu!", 400);

                Verification::where('user_id', auth()->user()->id)->delete();

                Verification::create([
                    'user_id' => auth()->user()->id,
                    'code' => rand(0000, 9999),
                    'via' => 'email',
                ]);

                // SendEmailActivation::dispatch($user);
                event(new UserRegistered(auth()->user()));

                return ResponseFormatter::success(['user' => auth()->user()], "Kode aktivasi telah kami kirim ke " . auth()->user()->email . " !");
            }
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 400);
        }
    }
}
