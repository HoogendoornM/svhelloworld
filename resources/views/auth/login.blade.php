@extends('layouts.master')
@section('title', __('Inloggen'))

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <form method="post" action="{{ action('Auth\LoginController@login') }}" class="form-horizontal">
                {!! csrf_field() !!}

                <div class="form-group">
                    <label for="email" class="control-label col-sm-4">{{__('HZ e-mailadres')}}</label>
                    <div class="col-sm-8">
                        <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="control-label col-sm-4">{{__('Wachtwoord')}}</label>
                    <div class="col-sm-8">
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember"> {{__('Onthoud mij')}}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8">
                        <button type="submit" class="btn btn-primary">{{__('Inloggen')}}</button>
                    </div>
                </div>
            </form>

            <p>{{__('Ben je je wachtwoord vergeten?')}} <a href="{{ route('account.password.email') }}">{{__('Wachtwoord opnieuw instellen.')}}</a></p>
            <p>{{__('Heb je nog geen account?')}} <a href="{{ route('register') }}">{{__('Maak een account aan!')}}</a></p>
        </div>
    </div>
@endsection
