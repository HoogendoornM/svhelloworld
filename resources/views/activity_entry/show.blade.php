@extends('layouts.master')
@section('title', __('Details aanmelding'))

@section('content')
    <div class="row">
        <div class="col-xs-12">
            @unless ($activity_entry->confirmed())
                <p class="alert alert-info">{{ __("Je aanmelding voor dit activiteit is nog niet bevestigd.") }}</p>
            @endunless

            <h2>{{ __("Aanmelding voor") }} {{ $activity_entry->activity->title }}</h2>
            <p>{{ __("Dit zijn de aanmeldingsgegevens van je aanmelding voor het activiteit") }} '{{ $activity_entry->activity->title }}'.</p>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th colspan="2">{{ __("Details over de aanmelding") }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ __("Prijs") }}</td>
                        @if($activity_entry->activity_price->amount > 0)
                            <td>&euro; {{ $activity_entry->activity_price->amount }}</td>
                        @else
                            <td>{{ __("Gratis") }}</td>
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
                            <td>{{ __("Aangemeld op") }}</td>
                            <td>@datetime($activity_entry->created_at)</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th colspan="2">{{ __("Details over de activiteit") }}</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ __("Activiteit") }}</td>
                        <td>{{ $activity_entry->activity->title }}</td>
                    </tr>
                    <tr>
                        <td>{{ __("Datum en tijd") }}</td>
                        <td>
                            @datetime($activity_entry->activity->starts_at) {{ __("t/m") }} @datetime($activity_entry->activity->ends_at)
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <h3>{{ __("Betalingen") }}</h3>
            @if ($activity_entry->payments->count())
                <p>{{ __("Dit is een overzicht van de betalingen behorende bij deze aanmelding.") }}</p>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __("Beschrijving") }}</th>
                                <th>{{ __("Status") }}</th>
                                <th>{{ __("Betaald op") }}</th>
                                <th>{{ __("Acties") }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($activity_entry->payments as $payment)
                            <tr>
                                <td>{{ $payment->id }}</th>
                                <td>{{ $payment->description }}</td>
                                <td>{!! $payment->paid() ? '<span class="label label-success">'.__('Betaald').'</span>' : '<span class="label label-warning">'.__('Nog niet betaald').' </span>' !!}</td>
                                <td>
                                    @if ($payment->paid())
                                        @datetime($payment->paid_at)
                                    @else
                                        N.v.t.
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('payment.show', $payment->id) }}" class="btn btn-primary btn-xs">{{ __("Bekijken") }}</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="alert alert-info">{{ __("Er zijn geen betalingen gevonden behorende bij deze aanmelding.") }}</p>
            @endif

            <a href="{{ route('activity_entry.index') }}" class="btn btn-default">{{ __("Terug naar overzicht") }}</a>
            @if(!$activity_entry->confirmed())
                <form action="{{ route('activity_entry.destroy', $activity_entry->id) }}" method="POST" style="display: inline-block">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <button class="btn btn-danger">{{ __("Afmelden") }}</button>
                </form>
            @endif
            <a href="{{ route('activity.show', $activity_entry->activity->id) }}" class="btn btn-primary">{{ __("Naar activiteit") }}</a>
        </div>
    </div>
@endsection
