@component('mail::message')
# Verify your email address

Click the button below to verify your email address.

@component('mail::button', ['url' => route('verify.email', ['token' => $verificationToken])])
Verify Email
@endcomponent

If you did not create an account, no further action is required.

Thanks,<br>
{{ config('app.name') }}
@endcomponent