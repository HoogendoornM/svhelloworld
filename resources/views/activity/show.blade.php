@extends('layouts.master')
@section('title', __('Details activiteit'))

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <h2>{{ $activity->title }}</h2>
            <p>
                {{ $activity->description }}
            </p>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th colspan="2">{{ __("Details over de activiteit") }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ __("Datum en tijd") }}</td>
                            <td>
                                @datetime($activity->starts_at) {{ __("t/m") }} @datetime($activity->ends_at)
                            </td>
                        </tr>
                        <tr>
                            <td>{{ __("Aanmeldperiode") }}</td>
                            <td>
                                @date($activity->available_from) {{ __("t/m") }} @date($activity->available_to)
                            </td>
                        </tr>
                        <tr>
                            <td>{{ __("ITP-waarde") }}</td>
                            <td>
                                @if(isset($activity->itp_value))
                                    {{ $activity->itp_value }}
                                @else
                                    {{ __("Onbekend") }}
                                @endif
                            </td>
                        </tr>
                        @if(isset($activity->member_limit))
                            <tr>
                                <td>{{ __("Totaal aantal plekken") }}</td>
                                <td>
                                    {{ $activity->member_limit }}
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __("Aantal plekken nog beschikbaar") }}</td>
                                <td>
                                    {{ max($activity->member_limit - $activity->entries()->count(), 0) }}
                                </td>
                            </tr>
                        @endif
                        <tr>
                            <td>{{ __("Prijs") }}</td>
                            @if($activity_price)
                                @if($activity_price->amount > 0)
                                    <td>&euro; {{ $activity_price->amount }}</td>
                                @else
                                    <td>{{ __("Gratis") }}</td>
                                @endif
                            @else
                                <td>{{ __("Onbekend") }}</td>
                            @endif
                        </tr>
                        @if($activity_entry)
                            <tr>
                                <td>{{ __("Status aanmelding") }}</td>
                                <td>
                                    @if ($activity_entry->confirmed())
                                        <span class="label label-success">{{ __("Aangemeld") }}</span>
                                    @else
                                        <span class="label label-info">{{ __("Nog niet bevestigd") }}</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __("Ingeschreven op") }}</td>
                                <td>@datetime($activity_entry->created_at)</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <a href="{{ route('activity.index') }}" class="btn btn-default">{{ __("Terug naar overzicht") }}</a>
            @if($activity_entry)
                <a href="{{ route('activity_entry.show', $activity_entry->id) }}" class="btn btn-primary">{{ __("Bekijk aanmelding") }}</a>
            @else
                @if(!isset($activity->member_limit) || $activity->entries()->count() < $activity->member_limit)
                    <a href="{{ route('activity_entry.create', $activity->id) }}" class="btn btn-primary">{{ __("Aanmelden") }}</a>
                @else
                    <a disabled class="btn btn-danger">{{ __("Aanmelden (vol)") }}</a>
                @endif
            @endif
        </div>
    </div>
@endsection
