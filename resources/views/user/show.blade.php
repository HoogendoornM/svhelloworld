@extends('layouts.master')
@section('back', route('user.index'))
@section('title', __('Details gebruiker'))

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <h2>{{ $user->full_name() }}</h2>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th colspan="2">{{ __("Gegevens") }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ __("Naam") }}</td>
                            <td>{{ $user->full_name() }}</td>
                        </tr>
                        <tr>
                            <td>{{ __("E-mailadres") }}</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <td>{{ __("E-mail status") }}</td>
                            <td>{!! $user->verified ? '<span class="label label-success">'. __('Geverifieerd').'</a>' : '<span class="label label-warning">'. __('Niet geverifieerd').'</span>' !!}</td>
                        </tr>
                        <tr>
                            <td>Account status</td>
                            <td>{!! $user->activated ? '<span class="label label-success">'. __('Geactiveerd').'</a>' : '<span class="label label-warning">'. __('Gedeactiveerd').'</span>' !!}</td>
                        </tr>
                        <tr>
                            <td>{{ __("Geregistreerd op") }}</td>
                            <td>{{ $user->created_at ? $user->created_at->format('d-m-Y \o\m H:i') : 'Onbekend' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <h2>{{ __("Gebruikersinformatie") }}</h2>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th colspan="2">Info</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Account type</td>
                            <td>{{ $user->account_type ? ucfirst($user->account_type) : 'Accounttype onbekend' }}</td>
                        </tr>
                        <tr>
                            <td>{{ __("Gebruikerscategorie") }}</td>
                            <td>{{ $user->user_category ? $user->user_category->title : 'Geen gebruikerscategorie' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary"><i class="fa fa-pencil"></i> {{ __("Gebruiker bewerken") }}</a>
        </div>
    </div>
@endsection
