@extends('layouts.master')
@section('title', __('Niet gevonden'))

@section('content')
	<p>{{ __('Oeps! De pagina die je zocht is niet gevonden. Ga naar de') }} <a href="{{ route('index') }}">{{ __('startpagina') }}</a>.</p>
@endsection
