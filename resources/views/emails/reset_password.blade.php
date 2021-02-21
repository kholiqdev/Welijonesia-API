@component('mail::message')
# Atur Ulang Kata Sandi

Kode permintaan atur ulang kata sandi anda.

@component('mail::panel')
{{$verification->code}}
@endcomponent

@component('mail::button', ['url' => url('customer/reset-password/'.base64_encode($verification->code))])
Atur Ulang Kata Sandi
@endcomponent

Terima Kasih,<br>
{{ config('app.name') }}
@endcomponent
