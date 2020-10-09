<?php

namespace App\Http\Controllers;

use App\Payment;
use Auth;
use App\User;
use App\Activity;
use App\ActivityEntry;
use Illuminate\Http\Request;
use App\Events\UserAppliedForActivity;
use App\Notifications\ActivityEntryConfirmed;
use Carbon\Carbon;

class ActivityEntryController extends Controller
{
    /**
     * Returns the index view.
     *
     * @return mixed The index view
     */
    public function index()
    {
        $activity_entries = Auth::user()->activity_entries;

        return view('activity_entry.index', compact('activity_entries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $user = Auth::user();

        if (is_null($id)) {
            return redirect(route('activity.index'));
        }

        // Get the activity information
        $activity = Activity::findOrFail($id);

        if (isset($activity->member_limit) && $activity->entries()->count() >= $activity->member_limit) {
            flash('Je kunt je niet aanmelden voor deze activiteit, omdat het maximale aantal deelnemers al bereikt is.', 'info');

            return redirect(route('activity.show', $activity->id));
        }

        $activity_entry = ActivityEntry::where([
            ['user_id', $user->id],
            ['activity_id', $activity->id],
        ])->first();

        if ($activity_entry) {
            flash('Je kunt je niet aanmelden voor deze activiteit, mogelijk omdat je je al hebt aangemeld.', 'info');

            return redirect(route('activity.show', $activity->id));
        }

        $activity_price = $activity->prices()
            ->where('user_category_alias', $user->user_category_alias)
            ->first();

        if (! $activity_price) {
            flash('Je kunt je niet aanmelden voor deze activiteit.', 'info');

            return redirect(route('activity.show', $activity->id));
        }

        return view('activity_entry.create', compact('user', 'activity', 'activity_price'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $messages = [
            'accept.required' => __('Je dient akkoord te gaan met de voorwaarden.'),
            'notes.string' => 'Vul een geldige opmerking in.',
        ];

        $this->validate($request, [
            'accept' => 'required|boolean',
            'notes' => 'string|nullable',
        ], $messages);

        $user = Auth::user();

        // Get the activity information
        $activity = Activity::findOrFail($id);

        //get today's date
        $today = Carbon::today();

        //Check if join date hasn't expired
        if(!($activity->available_from <= $today && $activity->available_to >= $today)) {
            flash(__('Aanmeldperiode is verlopen.'), 'info');
            return redirect(route('activity.show', $activity->id));
        }

        //Check member limit
        if($activity->entries()->count() >= $activity->member_limit && $activity->member_limit != 0 && $activity->member_limit != null) {
            flash(__('Het is niet meer mogelijk om je aan te melden voor deze acitviteit want, de activiteit heeft het maximum aantal deelnemers bereikt.'), 'info');
            return redirect(route('activity.show', $activity->id));
        }

        // Check if the user already has
        $activity_entry = ActivityEntry::where([
            ['user_id', $user->id],
            ['activity_id', $activity->id],
        ])->first();

        if ($activity_entry) {
            flash(__('Je kunt je niet aanmelden voor deze activiteit, omdat je je al hebt aangemeld.'), 'info');
            return redirect(route('activity.show', $activity->id));
        }

        // Check succesful, add new activity entry
        $activity_price = $activity->prices()
            ->where('user_category_alias', $user->user_category_alias)
            ->first();

        if (! $activity_price) {
            flash(__('Je kunt je niet aanmelden voor deze activiteit'), 'info');

            return redirect(route('activity.show', $activity->id));
        }

        $activity_entry = ActivityEntry::create([
            'user_id' => $user->id,
            'activity_id' => $activity->id,
            'activity_price_id' => $activity_price->id,
            'notes' => $request->notes,
        ]);

        // Check if the activity entry is created
        if (! $activity_entry) {
            flash(sprintf('Registration failed \'%s\' please try again.', $activity->title), 'danger');

            return back()->withInput();
        }

        if ($activity_price->amount > 0) {
            flash(sprintf(__('Je hebt je succesvol aangemeld voor de activiteit'). ' \'%s\', ' . __('je ontvangt binnenkort een mail met betalingsinstructies.'), $activity->title), 'success');

            // Fire 'UserAppliedForActivity' event
            event(new UserAppliedForActivity($activity_entry));

            return redirect(route('activity.show', $activity->id));
        }

        $activity_entry->confirmed_at = time();
        $activity_entry->save();

        // Send notification to user
        $user->notify(new ActivityEntryConfirmed($activity_entry->id, $activity_entry->activity->title));

        flash(sprintf(__('Je hebt je succesvol aangemeld voor de activiteit'). ' \'%s\'.', $activity->title), 'success');

        return redirect(route('activity.show', $activity->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $activity_entry = ActivityEntry::findOrFail($id);

        if (!$user->can('view', $activity_entry)) {
            return abort(403);
        }

        return view('activity_entry.show', compact('activity_entry'));
    }

    /**
     * Destroy the specified resource.
     *
     * @param $id
     */
    public function destroy($id) {
        $activity_entry = ActivityEntry::findOrFail($id);

        // Get the open, corresponding payment
        $payment = Payment::where('activity_entry_id', $id)
            ->where('status', 'open')->first();

        // If the open payment exists, delete it
        if (!is_null($payment)) {
            $payment->delete();
        }

        $activity_entry->delete();

        flash(sprintf(__('Je hebt je afgemeld voor'). ' \'%s\'.', $activity_entry->activity->title));

        return redirect(route('activity_entry.index'));
    }
}
