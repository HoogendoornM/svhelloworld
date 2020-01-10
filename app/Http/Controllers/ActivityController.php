<?php

namespace App\Http\Controllers;

use Auth;
use App\Activity;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\ActivityEntry;

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

        $activities = Activity::where([
            ['available_from', '<=', $today],
            ['available_to', '>=', $today],
        ])->get();

        return view('activity.index', compact('activities'));
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
        $activities = Activity::paginate(10);

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
        $activity_entries = ActivityEntry::where('activity_id', $id)->paginate(10);

        return view('activity.entries', compact('activity', 'activity_entries'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'event_name' => 'required|unique:activities,title|max:255',
            'description' => 'required',
            'available_from' => 'required',
            'available_to' => 'required',
            'starts_at' => 'required',
            'ends_at' => 'required',
        ]);

        Activity::create([
            'title' => request('event_name'),
            'description' => request('description'),
            'available_from' => request('available_from'),
            'available_to' => request('available_to'),
            'starts_at' => request('starts_at'),
            'ends_at' => request('ends_at'),
        ]);

        flash('Evenement toegevoegd!', 'success');

        return redirect(route('activity.index'));
    }
}
