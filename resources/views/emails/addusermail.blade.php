@component('mail::message')

Hello {{ $user['first_name']}} {{ $user['last_name']}},<br>
{{ $authuser['first_name']}} {{ $user['last_name']}} has added your account you can login and change your password</br>
Your current password is {{$randompassword}}

@component('mail::button',['url'=> route('login')])
    Click Here To Login and Change Your Password
@endcomponent
<p>Or Copy and Paste the following link to your browser</p>
<p><a href="{{route('login')}}">{{route('login')}}</a></p>


Thanks,<br>
{{ config('app.name') }}
@endcomponent
