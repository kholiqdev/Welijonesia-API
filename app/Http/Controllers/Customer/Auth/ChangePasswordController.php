<?php

namespace App\Http\Controllers\Customer\Auth;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\Auth\ChangePasswordRequest;
use Exception;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  ChangePasswordRequest  $request
     * @return json
     */
    public function __invoke(ChangePasswordRequest $request)
    {
        try {
            if (!Hash::check($request->password, auth()->user()->password)) {
                return ResponseFormatter::error('Password anda salah, periksa kembali!', 400);
            }
            auth()->user()->update([
                'password' => Hash::make($request->new_password)
            ]);
            return ResponseFormatter::success(auth()->user(), 'password berhasil diubah!');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 400);
        }
    }
}
