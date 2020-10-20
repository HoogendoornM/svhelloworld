@extends('layouts.master')
@section('title', __('Aanmeldingen activiteiten'))

@section('content')
    @if ($activity_entries->count())
        <p>{{ __("Dit is een overzicht van jouw aanmeldingen voor activiteiten.") }}</p>


        <div class="table-responsive">
            @if (App::isLocale('nl'))
                <table id="activities-entry-index-table" class="table table-bordered table-striped table-hover">
                    @else
                        <table id="activities-entry-index-table-en"
                               class="table table-bordered table-striped table-hover">
                            @endif
                            <thead>
                            <tr>
                                <th>{{ __("Name") }}</th>
                                <th>{{ __("Aangemeld op") }}</th>
                                <th>{{ __("Status") }}</th>
                                <th>{{ __("Acties") }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($activity_entries as $activity_entry)
                                <tr>
                                    <td>
                                        <a href="{{ route('activity_entry.show', $activity_entry->id) }}">{{ $activity_entry->activity->title }}</a>
                                    </td>
                                    <td>
                                        @datetime($activity_entry->created_at)
                                    </td>
                                    <td>
                                        @if ($activity_entry->confirmed())
                                            <span class="label label-success">{{ __("Aangemeld") }}</span>
                                        @else
                                            <span class="label label-info">{{ __("Nog niet bevestigd") }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('activity_entry.show', $activity_entry->id) }}"
                                           class="btn btn-primary btn-xs">Details</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
        </div>
    @else
        <p class="alert alert-info">{{ __("Op dit moment heb je je nog niet aangemeld voor een activiteit.") }}</p>
    @endif
@endsection
