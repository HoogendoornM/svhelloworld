@extends('layouts.master')
@section('title', __('Activiteiten aanmaken'))

@section('content')
    <p>
        {{ __('Formulier om een evenement aan te maken.') }}<br>
        {{ __('Let op: als het evenement gratis is vul dan 0.00 in.') }}<br>
        {{ __('Wil je geen deelnemer limiet instellen? Laat dan het veld "Maximaal aantal leden" leeg.') }}
    </p>

    <div class="row">
        <div class="col-xs-12">
            <form method="post" action="{{ route('activity.store') }}" class="form-horizontal">
                {!! csrf_field() !!}

                <div class="form-group {{ $errors->has('event_name') ? 'has-error' : ''}}">
                    <label for="event_name" class="control-label col-sm-2">{{ __('Naam') }} *</label>
                    <div class="col-sm-6">
                        <input type="text" name="event_name" id="event_name" value="{{ old('event_name') }}" class="form-control">
                        {!! $errors->first('event_name', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>

                <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                    <label for="description" class="control-label col-sm-2">{{ __('Beschrijving') }} *</label>
                    <div class="col-sm-6">
                        <textarea type="text" name="description" id="description" class="form-control">{{ old('description') }}</textarea>
                        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>

                <div class="form-group {{ $errors->has('itp_value') ? 'has-error' : ''}}">
                    <label for="itp_value" class="control-label col-sm-2">{{ __('ITP-waarde') }}</label>
                    <div class="col-sm-6">
                        <input type="number" step="0.01" name="itp_value" id="itp_value" value="{{ old('itp_value') }}" class="form-control">
                        {!! $errors->first('itp_value', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>

                <div class="form-group {{ $errors->has('event_price_member') ? 'has-error' : ''}}">
                    <label for="event_price_member" class="control-label col-sm-2">{{ __('Prijs leden') }} *</label>
                    <div class="col-sm-6">
                        <div class="input-group">
                            <div class="input-group-addon">€</div>
                            <input type="int" name="event_price_member" id="event_price_member" value="{{ old('event_price_member') }}" class="form-control">
                        </div>
                        {!! $errors->first('event_price_member', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>

                <div class="form-group {{ $errors->has('event_price_non_member') ? 'has-error' : ''}}">
                    <label for="event_price_non_member" class="control-label col-sm-2">{{ __('Prijs niet leden') }} *</label>
                    <div class="col-sm-6">
                        <div class="input-group">
                            <div class="input-group-addon">€</div>
                            <input type="int" name="event_price_non_member" id="event_price_non_member" value="{{ old('event_price_non_member') }}" class="form-control">
                        </div>
                        {!! $errors->first('event_price_non_member', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>

                <div class="form-group {{ $errors->has('member_limit') ? 'has-error' : ''}}">
                    <label for="member_limit" class="control-label col-sm-2">{{ __('Maximaal aantal deelnemers') }}</label>
                    <div class="col-sm-6">
                            <input type="int" name="member_limit" id="member_limit" value="{{ old('member_limit') }}" class="form-control">
                        {!! $errors->first('member_limit', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>

                <div class="form-group {{ $errors->has('available_from') ? 'has-error' : ''}}">
                    <label for="available_from" class="control-label col-sm-2">{{ __('Aanmeldingsperiode start') }} *</label>
                    <div class="col-sm-6">
                        <input type="date" name="available_from" id="available_from" value="{{ old('available_from') }}" class="form-control">
                        {!! $errors->first('available_from', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>

                <div class="form-group {{ $errors->has('available_to') ? 'has-error' : ''}}">
                    <label for="available_to" class="control-label col-sm-2">{{ __('Aanmeldingsperiode eind') }} *</label>
                    <div class="col-sm-6">
                        <input type="date" name="available_to" id="available_to" value="{{ old('available_to') }}" class="form-control">
                        {!! $errors->first('available_to', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>

                <div class="form-group {{ $errors->has('starts_at_date') || $errors->has('starts_at_time') ? 'has-error' : ''}}">
                    <label for="starts_at" class="control-label col-sm-2">{{ __('Evenement start') }} *</label>
                    <div class="col-sm-4">
                        <input type="date" name="starts_at_date" id="starts_at_date" value="{{ old('starts_at_date') }}" class="form-control">
                        {!! $errors->first('starts_at_date', '<p class="help-block">:message</p>') !!}
                    </div>
                    <div class="col-sm-2">
                        <input type="time" name="starts_at_time" id="starts_at_time" class="form-control" value="{{ old('starts_at_time') }}">
                        {!! $errors->first('starts_at_time', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>

                <div class="form-group {{ $errors->has('ends_at_date') || $errors->has('ends_at_time') ? 'has-error' : ''}}">
                    <label for="ends_at" class="control-label col-sm-2">{{ __('Evenement eind') }} *</label>
                    <div class="col-sm-4">
                        <input type="date" name="ends_at_date" id="ends_at_date" value="{{ old('ends_at_date') }}" class="form-control">
                        {!! $errors->first('ends_at_date', '<p class="help-block">:message</p>') !!}
                    </div>
                    <div class="col-sm-2">
                        <input type="time" name="ends_at_time" id="ends_at_time" class="form-control" value="{{ old('ends_at_time') }}">
                        {!! $errors->first('ends_at_time', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-6">
                        <button type="submit" class="btn btn-primary">{{ __('Aanmaken') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
