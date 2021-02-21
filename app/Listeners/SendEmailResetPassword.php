<?php

namespace App\Listeners;

use App\Events\UserForgotPassword;
use App\Helpers\ResponseFormatter;
use App\Mail\UserResetPassword;
use Illuminate\Support\Facades\Mail;

class SendEmailResetPassword
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserForgotPassword  $event
     * @return void
     */
    public function handle(UserForgotPassword $event)
    {
        if ($event->user->verifications->where('expired_at', '>', now())->first()) {
            try {
                Mail::to($event->user->email)->send(new UserResetPassword($event->user->verifications->where('expired_at', '>', now())->first()));
            } catch (\Throwable $e) {
                return ResponseFormatter::error($e->getMessage(), 400);
            }
        }
    }
}
