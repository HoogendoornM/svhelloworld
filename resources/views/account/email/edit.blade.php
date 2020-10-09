@extends('layouts.master')
@section('title', __('E-mailadres wijzigen'))

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <p>{{ __('Na het wijzigen van je e-mailadres moet je opnieuw je e-mailadres valideren voor je je kunt aanmelden voor activiteiten.') }} </p>

            <form method="post" action="{{ action('Account\EmailController@update') }}" class="form-horizontal">
                {!! csrf_field() !!}

                <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                    <label for="email" class="control-label col-sm-3">{{ __('Nieuw e-mailadres') }}</label>
                    <div class="col-sm-6">
                        <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control">
                        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>

                <div class="form-group {{ $errors->has('email_confirmation') ? 'has-error' : ''}}">
                    <label for="email" class="control-label col-sm-3">{{ __('Herhaal e-mailadres') }}</label>
                    <div class="col-sm-6">
                        <input type="email" name="email_confirmation" id="email_confirmation" class="form-control">
                        {!! $errors->first('email_confirmation', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-8">
                        <a href="{{ route('account.index') }}" class="btn btn-danger">{{ __('Annuleren') }}</a>
                        <button type="submit" class="btn btn-primary">{{ __('E-mailadres wijzigen') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
