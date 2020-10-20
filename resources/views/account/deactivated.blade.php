@extends('layouts.master')
@section('title', __('Account gedeactiveerd'))

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <p>{{  __('Je kunt je account niet gebruiken omdat het account is gedeactiveerd. Neem contact op indien het account ten onrechte is gedeactiveerd.') }}</p>
        </div>
    </div>
@endsection
