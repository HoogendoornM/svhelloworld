@extends('layouts.master')
@section('title', sprintf(__('Aanmeldingen').' for \'%s\'', $activity->title))

@section('content')
    @if ($activity_entries->count())
        <p>{{ __('Dit is een overzicht van aanmeldingen voor') }} '{{ $activity->title }}'.</p>

        <div class="table-responsive">
            @if (App::isLocale('nl'))
                <table id="activities-entries-table" class="table table-bordered table-striped table-hover">
                    @else
                        <table id="activities-entries-table-en" class="table table-bordered table-striped table-hover">
                            @endif
                <thead>
                    <tr>
                        <th>{{ __('Naam') }}</th>
                        <th>{{ __('Bevestigd') }}</th>
                        <th>{{ __('Opmerkingen') }}</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($activity_entries as $activity_entry)
                    <tr>
                        <td><a href="{{ route('user.show', $activity_entry->user->id) }}">{{ $activity_entry->user->full_name() }}</a></td>
                        <td>
                            @if ($activity_entry->confirmed())
                                <span class="label label-success">{{ __('Aangemeld') }}</span>
                            @else
                                <span class="label label-info">{{ __('Nog niet bevestigd') }}</span>
                            @endif
                        </td>
                        <td>{{ $activity_entry->notes }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table></table>
        </div>
    @else
        <p class="alert alert-info">{{ __('Er zijn op dit moment geen nieuwe aanmeldingen bekend.') }}</p>
    @endif
@endsection
