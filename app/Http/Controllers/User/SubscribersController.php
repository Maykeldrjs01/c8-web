<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlastSubscribers;
use RealRashid\SweetAlert\Facades\Alert;

class SubscribersController extends Controller
{
    private $subs;
    private $filterOptions;
    private $subsPaginated;

    public function __construct()
    {
       $this->subs = BlastSubscribers::orderBy('GROUP_ID', 'ASC')
            ->get(); 
       $this->subsPaginated = BlastSubscribers::orderBy('GROUP_ID', 'ASC')
            ->orderBy('NAME')
            ->paginate(12); 
       $this->filterOptions = $this->subs->keyBy('GROUP_ID');
    }

    public function showGroup(Request $request)
    {

        $number = $request->number;
        $name = $request->name;
        $filtered = $this->subs->where('SUBSCRIBER_NUMBER', $request->number);

        return response()->json(['name' => $name, 'number' => $number, 'groups' => $filtered]);
    }
    /**
     * Returns the unfiltered collection 
     * for dashboard view
     */
    public function index()
    {
        return view('user.dashboard',[
            'subs'=> $this->subsPaginated,
            'groups' => $this->filterOptions
        ]); 
    }

    /** 
     * Returns a filtered collection of subscribers
     * by the GROUP_ID in db
     */
    public function filters(Request $request)
    {
        $request->validate([
            'group' => 'required'
        ]);
        $filter = $request->group;
        $filtered = $this->subs->filter(function ($subs) use ($filter){
            if ($subs->GROUP_ID ==  $filter){
                return true;
            }
        });
        Alert::toast('Filter applied!', 'info');
        return view('user.dashboard', [
            'subs' => $filtered,
            'groups' => $this->filterOptions,
            'filter' => $filter
        ]);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function show(Request $request){
        /**
         * find record using the primary key
         * then pass the data to the edit form
         */
        $record = BlastSubscribers::where('NAME', $request->name)
            ->where('GROUP_ID', $request->group_id)
            ->first();

        $old_name = $record->NAME;
        $old_number = $record->SUBSCRIBER_NUMBER;
        $old_group = $record->GROUP_ID;

        return view('user.subscribers.edit',[
            'name' => $old_name,
            'number' => $old_number,
            'group' => $old_group,
        ]); 
    }
}