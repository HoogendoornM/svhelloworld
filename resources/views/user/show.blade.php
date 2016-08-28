@extends('layouts.master')
@section('back', url('user'))
@section('title', 'Details gebruiker')

{{-- Sidebar button --}}
@section('sidebar-nav')
    <li>
        <a href="{{ route('user.edit', $user->id) }}">
            <i class="fa fa-pencil"></i><span class="hidden-xs hidden-sm">Gebruiker bewerken</span>
        </a>
    </li>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <h2>{{ $user->first_name }} {{ $user->name_prefix }} {{ $user->last_name }}</h2>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th colspan="2">Gegevens</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Naam</td>
                            <td>{{ $user->first_name }} {{ $user->name_prefix }} {{ $user->last_name }}</td>
                        </tr>
                        <tr>
                            <td>E-mailadres</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <td>E-mailadres status</td>
                            <td>{!! $user->verified ? '<span class="label label-success">Geverifieerd</a>' : '<span class="label label-warning">Niet geverifieerd</span>' !!}</td>
                        </tr>
                        <tr>
                            <td>Account status</td>
                            <td>{!! $user->activated ? '<span class="label label-success">Geactiveerd</a>' : '<span class="label label-warning">Gedeactiveerd</span>' !!}</td>
                        </tr>
                        <tr>
                            <td>Geregistreerd op</td>
                            <td>{{ $user->created_at ? $user->created_at->format('d-m-Y \o\m H:i') : 'Onbekend' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <h2>Gebruikersinformatie</h2>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th colspan="2">Informatie</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Accounttype</td>
                            <td>{{ $user->account_type ? ucfirst($user->account_type) : 'Accounttype onbekend' }}</td>
                        </tr>
                        <tr>
                            <td>Gebruikerscategorie</td>
                            <td>{{ $user->user_category ? $user->user_category->title : 'Geen lid' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary"><i class="fa fa-pencil"></i> Gebruiker bewerken</a>
        </div>
    </div>
@endsection
