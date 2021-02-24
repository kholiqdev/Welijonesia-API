<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Helpers\ResponseFormatter;

class SendSMSActivation
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
        if ($event->user->status == 0 && $event->user->verifications->where('expired_at', '>', now())->first() && $event->user->verifications->via == 'sms') {
            try {
                $userkey = '808fded6569b';
                $passkey = '0b2544301396d8d2e38d50fc';
                $telepon = '0' + $event->user->phone;
                $message = "<#> Kode Otentikasi Welijonesia Anda : 8 5 7 4 \nHarap segera lakukan aktivasi.";
                $url = 'https://console.zenziva.net/reguler/api/sendsms/';
                $curlHandle = curl_init();
                curl_setopt($curlHandle, CURLOPT_URL, $url);
                curl_setopt($curlHandle, CURLOPT_HEADER, 0);
                curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
                curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($curlHandle, CURLOPT_TIMEOUT, 30);
                curl_setopt($curlHandle, CURLOPT_POST, 1);
                curl_setopt($curlHandle, CURLOPT_POSTFIELDS, array(
                    'userkey' => $userkey,
                    'passkey' => $passkey,
                    'to' => $telepon,
                    'message' => $message
                ));
                $results = json_decode(curl_exec($curlHandle), true);
                curl_close($curlHandle);
            } catch (\Exception $e) {
                return ResponseFormatter::error($e->getMessage(), 400);
            }
        }
    }
}
