@extends('layouts.master')
@section('title', __("Mijn SV \"Hello World\""))

@section('content')
    <p>
        {{  __('Mijn SV "Hello World" is het portaal voor alle leden van Studievereniging "Hello World", maar ook niet-leden mogen zich aanmelden voor activiteiten via dit portaal! Je moet hiervoor wel student zijn aan de opleiding HBO-ICT van de HZ University of Applied Sciences.') }}
    </p>

    <p>
        {{ __("Als je nieuwe ideeën hebt voor dit portaal mag je deze indienen op") }} <a
            href="https://github.com/sv-helloworld/mijn-sv-helloworld"
            target="_blank">{{ __("onze GitHub-pagina") }}</a>.
    </p>

    <p>
        {{ __("Met vriendelijke groet,") }}<br>
        {{ __("Studievereniging") }} "Hello World"
    </p>
@endsection
