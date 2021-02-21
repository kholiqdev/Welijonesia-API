@component('mail::message')
# Aktivasi Akun

Terima kasih telah mendaftar, harap aktivasi akun anda.

@component('mail::panel')
{{$verification->code}}
@endcomponent

{{-- @component('mail::button', ['url' => ''])
Activate
@endcomponent --}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
