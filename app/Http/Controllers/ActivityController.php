<?php

namespace App\Http\Controllers;

use Auth;
use App\Activity;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\ActivityEntry;
use App\ActivityPrice;

class ActivityController extends Controller
{
    /**
     * Returns the index view.
     *
     * @return mixed The index view
     */
    public function index()
    {
        $today = Carbon::today();

        $availableActivities = Activity::where([
            ['available_from', '<=', $today],
            ['available_to', '>=', $today],
        ])->get();

        $upcomingActivities = Activity::where([
            ['available_from', '>', $today],
            ['available_to', '>', $today],
        ])->get();

        $finishedActivities = Activity::where([
            ['available_to', '<', $today],
        ])->get();

        return view(
            'activity.index',
            [
                'availableActivities' => $availableActivities,
                'upcomingActivities' => $upcomingActivities,
                'finishedActivities' => $finishedActivities
            ]
        );
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
        $activity = Activity::findOrFail($id);
        $activity_entry = ActivityEntry::where([
            ['user_id', $user->id],
            ['activity_id', $activity->id],
        ])->first();

        $activity_price = $activity->prices()
            ->where('user_category_alias', $user->user_category_alias)
            ->first();

        return view('activity.show', compact('activity', 'activity_entry', 'activity_price'));
    }

    /**
     * Display a listing of the resources for administrators.
     *
     * @return \Illuminate\Http\Response
     */
    public function manage()
    {
        $activities = Activity::latest()->get();

        return view('activity.manage', compact('activities'));
    }

    /**
     * Display a listing of the resources for administrators.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('activity.create');
    }

    /**
     * Display a specified listing of the resources for administrators.
     *
     * @param int $id The id of the activity
     * @return \Illuminate\Http\Response
     */
    public function entries($id)
    {
        $activity = Activity::findOrFail($id);
        $activity_entries = ActivityEntry::where('activity_id', $id)->get();

        return view('activity.entries', compact('activity', 'activity_entries'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'event_name' => 'required|unique:activities,title|max:255',
            'description' => 'required',
            'itp_value' => 'numeric|min:0|max:100',
            'event_price_member' => 'required|numeric|min:0|max:1000',
            'event_price_non_member' => 'required|numeric|max:1000',
            'member_limit' => 'int',
            'available_from' => 'required|date',
            'available_to' => 'required|date',
            'starts_at_date' => 'required|date',
            'starts_at_time' => 'required|date_format:"H:i"',
            'ends_at_date' => 'required|date',
            'ends_at_time' => 'required|date_format:"H:i"',
        ]);

        $startsAtDate = request('starts_at_date');
        $startsAtTime = request('starts_at_time');
        $startsAtDateTime = date('Y-m-d H:i:s', strtotime("$startsAtDate $startsAtTime"));

        $endsAtDate = request('ends_at_date');
        $endsAtTime = request('ends_at_time');
        $endsAtDateTime = date('Y-m-d H:i:s', strtotime("$endsAtDate $endsAtTime"));

        $activity = Activity::create([
            'title' => request('event_name'),
            'description' => request('description'),
            'itp_value' => (isset($activity->itp_value)) ? request('itp_value') : null,
            'member_limit' => (isset($activity->member_limit)) ? request('member_limit') : null,
            'available_from' => request('available_from'),
            'available_to' => request('available_to'),
            'starts_at' => $startsAtDateTime,
            'ends_at' => $endsAtDateTime,
        ]);

        $activityPriceMember = ActivityPrice::create([
            'activity_id' => $activity->id,
            'user_category_alias' => 'lid',
            'amount' => request('event_price_member'),
        ]);

        $activityPriceNonMember = ActivityPrice::create([
            'activity_id' => $activity->id,
            'user_category_alias' => 'geen-lid',
            'amount' => request('event_price_non_member'),
        ]);

        flash(__('Evenement toegevoegd!'), 'success');

        return redirect(route('activity.index'));
    }
}
