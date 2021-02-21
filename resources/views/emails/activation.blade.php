@component('mail::message')
# Activation your account

Thanks for signing up, please activate your account.

@component('mail::panel')
{{$verification->code}}
@endcomponent

{{-- @component('mail::button', ['url' => ''])
Activate
@endcomponent --}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
