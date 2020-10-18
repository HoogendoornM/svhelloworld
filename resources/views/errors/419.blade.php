@extends('layouts.master')
@section('title', __('Pagina is verlopen'))

@section('content')
	<p>{{ __('Oeps! De pagina die je probeert te bezoeken is verlopen. Ga naar de') }} <a href="{{ route('index') }}">{{ __('startpagina') }}</a>.</p>
@endsection
