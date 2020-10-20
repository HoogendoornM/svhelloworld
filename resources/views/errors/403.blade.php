@extends('layouts.master')
@section('title', __('Niet toegankelijk'))

@section('content')
	<p>{{ __('Oeps! De pagina die je probeert te bezoeken is niet toegankelijk. Ga naar de') }} <a href="{{ route('index') }}">{{ __('startpagina') }}</a>.</p>
@endsection
