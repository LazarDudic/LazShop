@component('mail::message')
# {{ config('app.name') }}

{{ $user['comment'] }}

{{ $user['name'] }}<br>
{{ $user['email'] }}
@endcomponent
