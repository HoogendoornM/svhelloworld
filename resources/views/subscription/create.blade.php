@extends('layouts.master')
@section('title', __('Inschrijven'))

@section('content')
    <p>
        {{ __('Op deze pagina kun je je inschrijven als lid bij onze studievereniging voor de periode') }} '{{ $contribution->period->name }}'.
        {{ __('De contributie voor deze periode bedraagt') }} &euro;{{ $contribution->amount }}.
    </p>

    @if ($contribution->is_early_bird)
        <p class="alert alert-info">{{ __('Dit is een Early Bird-contributie. Als je je inschrijft voor') }} <strong>@datetime($contribution->available_to)</strong> {{ __('bedraagt de contributie slechts') }} <strong>&euro;{{ $contribution->amount }}</strong>!</strong></p>
    @endif

    <p>{{ __('Controleer de gegevens in het onderstaande formulier goed! Gegevens kun je aanpassen bij') }} <a href="{{ route('account.edit') }}" target="_blank">{{ __('accountbeheer') }}</a>.</p>

    <div class="row">
        <div class="col-xs-12">
            {!! Form::open(['url' => route('subscription.store', $contribution->period->slug), 'class' => 'form-horizontal']) !!}

            <div class="form-group">
                    {!! Form::label('first_name', __('Voornaam').' *', ['class' => 'col-sm-4 control-label']) !!}
                <div class="col-sm-8">
                    {!! Form::text('first_name', $user->first_name, ['readonly', 'class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                    {!! Form::label('name_prefix', __('Tussenvoegsel'), ['class' => 'col-sm-4 control-label']) !!}
                <div class="col-sm-8">
                    {!! Form::text('name_prefix', $user->name_prefix, ['readonly', 'class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                    {!! Form::label('last_name', __('Achternaam').' *', ['class' => 'col-sm-4 control-label']) !!}
                <div class="col-sm-8">
                    {!! Form::text('last_name', $user->last_name, ['readonly', 'class' => 'form-control']) !!}
                </div>
            </div>

            <hr>

            <div class="form-group">
                {!! Form::label('email', __('E-mail adres').' *', ['class' => 'col-sm-4 control-label']) !!}
                <div class="col-sm-8">
                    {!! Form::email('email', $user->email, ['readonly', 'class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('phone_number', __('Telefoonnummer').' *', ['class' => 'col-sm-4 control-label']) !!}
                <div class="col-sm-8">
                    {!! Form::text('phone_number', $user->phone_number, ['readonly', 'class' => 'form-control']) !!}
                </div>
            </div>

            <hr>

            <div class="form-group">
                {!! Form::label('address', __('Adres').' *', ['class' => 'col-sm-4 control-label']) !!}
                <div class="col-sm-8">
                    {!! Form::text('address', $user->address, ['readonly', 'class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('zip_code', __('Postcode').' *', ['class' => 'col-sm-4 control-label']) !!}
                <div class="col-sm-8">
                    {!! Form::text('zip_code', $user->zip_code, ['readonly', 'class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('city', __('Stad').' *', ['class' => 'col-sm-4 control-label']) !!}
                <div class="col-sm-8">
                    {!! Form::text('city', $user->city, ['readonly', 'class' => 'form-control']) !!}
                </div>
            </div>

            <hr>

            <div class="form-group {{ $errors->has('accept') ? 'has-error' : ''}}">
                <div class="col-sm-offset-4 col-sm-8">
                    <div class="checkbox">
                        <label>
                            {!! Form::checkbox('accept', '1', false) !!} {{ __('Ik bevestig hiermee mijn inschrijving en ga akkoord met de betaling van de contributie.') }}
                        </label>
                    </div>

                    {!! $errors->first('accept', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-4 col-sm-8">
                    {!! Form::button(__('Inschrijven als lid'), ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
                    <a href="{{ route('subscription.index') }}" class="btn btn-danger">{{ __('Annuleren') }}</a>
                </div>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
@endsection
