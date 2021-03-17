@component('mail::message')
# Welcome to {{ config('app.name') }}

You have been successfully registered.

@component('mail::button', ['url' => route('home')])
Visit
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
