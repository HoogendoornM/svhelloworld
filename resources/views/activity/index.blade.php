@extends('layouts.master')
@section('title', __('Aanmelden activiteiten'))

@section('content')
    @if ($availableActivities->count() + $upcomingActivities->count())
        <p>{{ __("Dit is een overzicht van de activiteiten die georganiseerd worden door Studievereniging \"Hello World\".") }}</p>

        @if ($availableActivities->count())
            <h3>{{ __("Beschikbare activiteiten") }}</h3>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
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
                    @foreach($availableActivities as $activity)
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
                                <a href="{{ route('activity.show', $activity->id) }}" class="btn btn-primary btn-xs">{{ __("Bekijken") }}</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        @if($upcomingActivities->count())
            <h3>{{ __("Toekomstige activiteiten") }}</h3>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
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
                    @foreach($upcomingActivities as $activity)
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
                                <a href="{{ route('activity.show', $activity->id) }}" class="btn btn-primary btn-xs">{{ __("Bekijken") }}</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        @if($finishedActivities->count())
            <h3>{{ __("Afgelopen activiteiten") }}</h3>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
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
                    @foreach($finishedActivities as $activity)
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
                                <a href="{{ route('activity.show', $activity->id) }}" class="btn btn-primary btn-xs">{{ __("Bekijken") }}</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    @else
        <p class="alert alert-info">{{ __("Op dit moment zijn er geen activiteiten beschikbaar, kijk op een later moment nog eens!") }}</p>
    @endif
@endsection
