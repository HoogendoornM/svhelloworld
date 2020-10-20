@extends('layouts.master')
@section('title', __('Details inschrijving'))

@section('content')
<div class="row">
    <div class="col-xs-12">
        <h2>{{ $subscription->contribution->period->name }}</h2>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th colspan="2">{{ __('Details van de inschrijving') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ __('Contributie') }}</td>
                        <td>
                            <div>
                                @if ($subscription->contribution->is_early_bird)
                                    <span class="label label-success label-offset-right">Early Bird</span>
                                @endif
                                &euro; {{ $subscription->contribution->amount }}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>{{ __('Periode') }}</td>
                        <td>
                            <div>{{ $subscription->contribution->period->name }}</div>
                            <small class="text-muted">@date($subscription->contribution->period->start_date) {{ __('tot') }} @date($subscription->contribution->period->end_date)</small>
                        </td>
                    </tr>
                    <tr>
                        <td>{{ __('Status inschrijving') }}</td>
                        <td>
                            @if ($subscription->canceled())
                                <span class="label label-danger">{{ __('Inschrijving stopgezet') }}</span>
                            @elseif ($subscription->confirmed())
                                <span class="label label-success">{{ __('Ingeschreven') }}</span>
                            @elseif ($subscription->approved())
                                <span class="label label-info">{{ __('Inschrijvingsverzoek goedgekeurd') }}</span>
                            @elseif ($subscription->declined())
                                <span class="label label-danger">{{ __('Inschrijvingsverzoek geweigerd') }}</span>
                            @else
                                <span class="label label-info">{{ __('Inschrijvingsverzoek ingediend') }}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>{{ __('Ingeschreven op') }}</td>
                        <td>@datetime($subscription->created_at)</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <h3>{{ __('Betalingen') }}</h3>
        @if ($subscription->payments->count())
            <p>{{ __('Dit is een overzicht van de betalingen behorende bij deze inschrijving.') }}</p>

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('Beschrijving') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Betaald op') }}</th>
                            <th>{{ __('Acties') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($subscription->payments as $payment)
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
                                    <a href="{{ route('payment.show', $payment->id) }}" class="btn btn-primary btn-xs">{{ __('Bekijken') }}</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="alert alert-info">{{ __('Er zijn geen betalingen gevonden behorende bij deze inschrijving.') }}</p>
        @endif

        <a href="{{ route('subscription.index') }}" class="btn btn-primary">{{ __('Terug naar overzicht') }}</a>
    </div>
</div>
@endsection
