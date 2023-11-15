@if ($message = Session::get('error'))
<div class="alert alert-danger" role="alert" id="message">
    {{$message}}
</div>
@endif
@if ($message = Session::get('success'))
<div class="alert alert-success" role="alert" id="message">
   {{$message}}
</div>
@endif
