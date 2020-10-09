@extends('layouts.master')
@section('title', __('Betalingen'))

@section('content')
    <h3>{{ __('Openstaande betalingen') }}</h3>
    @if ($open_payments->count())
        <p>{{ __('Dit is een overzicht van openstaande betalingen.') }}</p>

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __('Beschrijving') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Acties') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($open_payments as $payment)
                        <tr>
                            <td>{{ $payment->id }}</th>
                            <td>{{ $payment->description }}</td>
                            <td>{!! $payment->paid() ? '<span class="label label-success">'.__('Betaald').'</span>' : '<span class="label label-warning">'.__('Nog niet betaald').' </span>' !!}</td>
                            <td>
                                <a href="{{ route('payment.show', $payment->id) }}" class="btn btn-primary btn-xs">{{ __('Bekijken') }}</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="alert alert-info">{{ __('Je hebt op dit moment geen openstaande betalingen.') }}</p>
    @endif

    <h3>{{ __('Betalingsgeschiedenis') }}</h3>
    @if ($finalized_payments->count())
        <p>{{ __('Dit is een overzicht van afgeronde betalingen.') }}</p>

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
                    @foreach($finalized_payments as $payment)
                        <tr>
                            <td>{{ $payment->id }}</th>
                            <td>{{ $payment->description }}</td>
                            <td>{!! $payment->paid() ? '<span class="label label-success">'.__('Betaald').'</span>' : '<span class="label label-warning">'.__('Nog niet betaald').' </span>' !!}</td>
                            <td>@datetime($payment->paid_at)</td>
                            <td>
                                <a href="{{ route('payment.show', $payment->id) }}" class="btn btn-primary btn-xs">{{ __('Bekijken') }}</a>
                                <a href="{{ route('payment.invoice', $payment->id) }}" class="btn btn-primary btn-xs">{{ __('Factuur') }}</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="alert alert-info">{{ __('Je hebt op dit moment nog geen afgeronde betalingen.') }}</p>
    @endif
@endsection
