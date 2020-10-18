@extends('layouts.master')
@section('title', __('Activiteiten overzicht'))

@section('content')
    @if ($activities->count())
        <p>{{ __('Dit is een overzicht van alle activiteiten.') }}</p>

        <div class="table-responsive">
            @if (App::isLocale('nl'))
                <table id="activity-manage-table" class="table table-bordered table-striped table-hover">
                    @else
                        <table id="activity-manage-table-en" class="table table-bordered table-striped table-hover">
                            @endif
                            <thead>
                            <tr>
                                <th>{{ __("Naam") }}</th>
                                <th>{{ __("Datum en tijd") }}</th>
                                <th>{{ __("Aanmeldperiode") }}</th>
                                <th>{{ __("ITP-waarde") }}</th>
                                <th>{{ __("Acties") }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($activities as $activity)
                                <tr>
                                    <td>
                                        <a href="{{ route('activity.show', $activity->id) }}">{{ $activity->title }}</a>
                                    </td>
                                    <td>
                                        @datetime($activity->starts_at) {{ __("t/m") }} @datetime($activity->ends_at)
                                    </td>
                                    <td>
                                        @date($activity->available_from) {{ __("t/m") }} @date($activity->available_to)
                                    </td>
                                    <td>
                                        @if(isset($activity->itp_value))
                                            {{ $activity->itp_value }}
                                        @else
                                            {{ __("Onbekend") }}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('activity.entries', $activity->id) }}"
                                           class="btn btn-primary btn-xs">{{ __("Aanmeldingen") }}</a>
                                        <a href="{{ route('activity.show', $activity->id) }}"
                                           class="btn btn-primary btn-xs">{{ __("Activiteit informatie") }}</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                </table>
        </div>
    @else
        <p class="alert alert-info">{{ __("Er zijn op dit moment geen activiteiten.") }}</p>
    @endif
@endsection
