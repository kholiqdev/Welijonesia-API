<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Helpers\ResponseFormatter;
use App\Mail\UserActivation;
use Illuminate\Support\Facades\Mail;

class SendEmailActivation
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
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        if ($event->user->status == 0 && $event->user->verifications->where('expired_at', '>', now())->first() && $event->user->verifications->first()->via == 'email') {
            try {
                Mail::to($event->user->email)->send(new UserActivation($event->user->verifications->where('expired_at', '>', now())->first()));
            } catch (\Throwable $e) {
                return ResponseFormatter::error($e->getMessage(), 400);
            }
        }
    }
}
