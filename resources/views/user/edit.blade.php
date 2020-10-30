@extends('layouts.master')
@section('back', route('user.show', $user->id))
@section('title', __('Wijzig gebruiker'))

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <h2>{{ $user->name }}</h2>

            {!! Form::model($user, [
                'method' => 'PATCH',
                'url' => ['gebruikers', $user->id],
                'class' => 'form-horizontal'
            ]) !!}

            <div class="form-group {{ $errors->has('first_name') ? 'has-error' : ''}}">
                {!! Form::label('first_name', __('Voornaam') .' *', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('first_name', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('name_prefix') ? 'has-error' : ''}}">
                {!! Form::label('name_prefix', __('Tussenvoegsel'), ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('name_prefix', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('name_prefix', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('last_name') ? 'has-error' : ''}}">
                {!! Form::label('last_name', __('Achternaam') .' *', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('last_name', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <hr>

            <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                {!! Form::label('email', __('E-mailadres') .' *', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::email('email', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('phone_number') ? 'has-error' : ''}}">
                {!! Form::label('phone_number', __('Telefoonnummer') .' *', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('phone_number', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('phone_number', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <hr>

            <div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
                {!! Form::label('address', __('Adres') .' *', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('address', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('zip_code') ? 'has-error' : ''}}">
                {!! Form::label('zip_code', __('Postcode') .' *', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('zip_code', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('zip_code', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('city') ? 'has-error' : ''}}">
                {!! Form::label('city', __('Stad') .' *', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('city', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('city', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <hr>

            <div class="form-group {{ $errors->has('shirt_size') ? 'has-error' : ''}}">
                {!! Form::label('shirt_size', __('Shirt maat'), ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::select('shirt_size', ['XS' => 'XS', 'S' => 'S', 'M' => 'M', 'L' => 'L' , 'XL' => 'XL'], old('shirt_size') ? old('shirt_size') : $user->shirt_size, ['class' => 'form-control']) !!}
                    {!! $errors->first('shirt_size', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <hr>

            <div class="form-group {{ $errors->has('account_type') ? 'has-error' : ''}}">
                {!! Form::label('account_type', 'Account type *', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::select('account_type', ['user' => 'Gebruiker', 'admin' => 'Administrator'], null, ['class' => 'form-control']) !!}
                    {!! $errors->first('account_type', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('activated') ? 'has-error' : ''}}">
                {!! Form::label('activated', 'Account status *', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::select('activated', [1 => 'Geactiveerd', 0 => 'Gedeactiveerd'], null, ['class' => 'form-control']) !!}
                    {!! $errors->first('activated', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('user_category_alias') ? 'has-error' : ''}}">
                {!! Form::label('user_category_alias', __('Gebruikerscategorie') .' *', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::select('user_category_alias', array_replace(['' => 'Geen gebruikerscategorie'], $user_categories_values), null, ['class' => 'form-control']) !!}
                    {!! $errors->first('user_category_alias', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-6">
                    {!! Form::button(__('Gebruiker wijzigen'), ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
                    <a href="{{ route('user.show', $user->id) }}" class="btn btn-danger">{{ __('Annuleren') }}</a>
                </div>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('sidebar')
    <section class="widget">
        <h2 class="widget-title">{{ __('Gebruiker beheren') }}</h2>
        <div class="widget-content">
            {!! Form::open([
                'method'=>'PATCH',
                'route' => ['user.activate', $user->id]
            ]) !!}
                @if ($user->activated)
                    {!! Form::hidden('activated', false) !!}
                    {!! Form::button('Deactiveren', ['type' => 'submit', 'class' => 'btn btn-warning btn-block btn-sm']) !!}
                @else
                    {!! Form::hidden('activated', true) !!}
                    {!! Form::button('Activeren', ['type' => 'submit', 'class' => 'btn btn-success btn-block btn-sm']) !!}
                @endif
            {!! Form::close() !!}

            {!! Form::open([
                'method'=>'DELETE',
                'url' => ['gebruikers', $user->id]
            ]) !!}
                {!! Form::button('<i class="fa fa-trash"></i> Gebruiker verwijderen', ['type' => 'submit', 'class' => 'btn btn-danger btn-block btn-sm']) !!}
            {!! Form::close() !!}
        </div>
    </section>
@endsection
