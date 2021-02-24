<?php

namespace App\Http\Controllers\Customer\Auth;

use App\Events\UserRegistered;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\Auth\RegisterRequest;
use App\Jobs\SendEmailActivation;
use App\Models\User;
use App\Models\Verification;
use App\Models\Wallet;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  RegisterRequest  $request
     * @return json
     */
    public function __invoke(RegisterRequest $request)
    {
        DB::beginTransaction();

        try {
            $user = User::create([
                'name' => $request->name,
                'gender' => $request->gender,
                'phone' => $request->phone,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'customer',
            ]);

            Wallet::create([
                'user_id' => $user->id,
                'balance' => 10000
            ]);

            Verification::create([
                'user_id' => $user->id,
                'code' => rand(0000, 9999),
                'via' => 'email',
            ]);

            // SendEmailActivation::dispatch($user);
            event(new UserRegistered($user));

            DB::commit();

            if ($token = JWTAuth::fromUser($user)) {
                return ResponseFormatter::success(['token' => $token], 'Registrasi sukses, harap aktivasi akun anda!');
            }

            return ResponseFormatter::error("Registrasi gagal, harap periksa kembali!", 400);
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();

            return ResponseFormatter::error($e->getMessage(), 400);
        }
    }
}
