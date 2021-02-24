<?php

namespace App\Providers;

use App\Events\{UserForgotPassword, UserRegistered};
use App\Listeners\SendEmailActivation;
use App\Listeners\SendEmailResetPassword;
use App\Listeners\SendSMSActivation;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        UserRegistered::class => [
            SendEmailActivation::class,
            SendSMSActivation::class,
        ],
        UserForgotPassword::class => [
            SendEmailResetPassword::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
