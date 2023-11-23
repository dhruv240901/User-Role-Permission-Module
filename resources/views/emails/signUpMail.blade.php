@component('mail::message')

Hello {{ $adminUser['first_name'] }} {{ $adminUser['last_name'] }},
{{ $user['first_name'] }} {{ $user['last_name'] }} has added account. Please active it if it is a valid account.

@component('mail::button',['url'=> route('login')])
    Click Here To Login And Active Account
@endcomponent
<p>Or Copy and Paste the following link to your browser</p>
<p><a href="{{route('login')}}">{{route('login')}}</a></p>


Thanks,<br>
{{ config('app.name') }}
@endcomponent
