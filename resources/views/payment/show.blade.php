@extends('layouts.master')
@section('back', route('payment.index'))
@section('title', __('Details betaling'))

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <h2>{{ $payment->description }}</h2>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th colspan="2">{{ __('Gegevens') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ __('Volgnummer') }}</td>
                            <td>{{ $payment->id }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('Bedrag') }}</td>
                            <td>&euro; {{ $payment->amount }}</td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>{!! $payment->paid() ? '<span class="label label-success">'.__('Betaald').'</span>' : '<span class="label label-warning">'.__('Nog niet betaald').' </span>' !!}</td>
                        </tr>
                        @if ($payment->paid())
                            <tr>
                                <td>{{ __('Betaald op') }}</td>
                                <td>@datetime($payment->paid_at)</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            @if (! $payment->paid())
                <a href="{{ route('payment.pay', $payment->id) }}" class="btn btn-primary">{{ __('Betalen') }}</a>
                <a href="{{ route('payment.index') }}" class="btn btn-danger">{{ __('Annuleren') }}</a>
            @else
                <a href="{{ route('payment.index') }}" class="btn btn-primary">{{ __('Terug naar overzicht') }}</a>
                <a href="{{ route('payment.invoice', $payment->id) }}" class="btn btn-primary">{{ __('Factuur downloaden') }}</a>
            @endif
        </div>
    </div>
@endsection
