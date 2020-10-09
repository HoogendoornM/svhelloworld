@extends('layouts.master')
@section('title', __('Gebruikers beheren'))

@section('content')

    <p>
        <a class="btn btn-primary" href="{{ route('user.create') }}">{{ __('Maak nieuwe gebruiker') }}</a>
        <a class="btn btn-primary" href="{{ route('user.members') }}">{{ __('Bekijk alle leden') }}</a>
    </p>

    <div class="table-responsive">
        @if (App::isLocale('nl'))
            <table id="user-index-table" class="table table-bordered table-striped table-hover">
                @else
                    <table id="user-index-table-en" class="table table-bordered table-striped table-hover">
                        @endif
            <thead>
            <tr>
                <th></th>
                <th>{{ __('Naam') }}</th>
                <th>{{ __('E-mailadres') }}</th>
                <th>{{ __('Registratiedatum') }}</th>
                <th>{{ __('Status') }}</th>
                <th>{{ __('Acties') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td><img src="{{ Gravatar::src($user->email, 40) }}" alt="{{ $user->first_name }}" class="avatar">
                    </td>
                    <td><a href="{{ route('user.show', $user->id) }}">{{ $user->full_name() }} </a></td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>{!! $user->verified ? '<span class="label label-success">'. __('Geverifieerd').'</a>' : '<span class="label label-warning">'. __('Niet geverifieerd').'</span>' !!}</td>
                    <td>
                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary btn-xs"><i
                                    class="fa fa-pencil"></i> {{ __('Bewerk') }}</a>
                        <a href="{{ route('payment.user', $user->id) }}" class="btn btn-primary btn-xs"><i
                                    class="fa fa-money"></i> {{ __('Betalingen') }}</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
