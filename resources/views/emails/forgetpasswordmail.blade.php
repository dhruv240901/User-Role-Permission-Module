@component('mail::message')

Hello {{ $firstName }} {{ $lastName }}

@component('mail::button',['url'=> route('view-reset-password',$token)])
    Click Here To Reset Your Password
@endcomponent
<p>Or Copy and Paste the following link to your browser</p>
<p><a href="{{route('view-reset-password',$token)}}">{{route('view-reset-password',$token)}}</a></p>


Thanks,<br>
{{ config('app.name') }}
@endcomponent
