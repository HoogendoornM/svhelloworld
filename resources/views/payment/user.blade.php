@extends('layouts.master')
@section('back', url('user'))
@section('title', __('Betalingen gebruiker'))

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <p>{{ __('Overzicht van de betalingen van gebruiker') }} {{ $user->full_name() }}.</p>

            @if($user->payments->count())
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <th>{{ __('Beschrijving') }}</th>
                            <th>{{ __('Bedrag') }}</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($user->payments as $payment)
                            <tr>
                                <td>{{ $payment->description }}</td>
                                <td>&euro;{{ $payment->amount }}</td>
                                <td>{!! $payment->paid() ? '<span class="label label-success">'. __('Betaald').'</a>' : '<span class="label label-warning">'. __('Nog niet betaald').'</span>' !!}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="alert alert-info">{{ __('Deze gebruiker heeft op dit moment nog geen betalingen.') }}</p>
            @endif
        </div>
    </div>
@endsection
