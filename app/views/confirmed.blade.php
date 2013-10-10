@extends('layouts.default')

@section('content')

<h1>Your Order has been Confirmed</h1>

<p>You can now download your file using the button below:</p>

<p><a href="/download/{{ $download->id }}" class="btn btn-lg btn-primary">Download</a></p>

@stop


