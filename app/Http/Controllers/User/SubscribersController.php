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
       $this->subs = BlastSubscribers::orderBy('group_id', 'ASC')->get(); 
       $this->subsPaginated = BlastSubscribers::orderBy('group_id', 'ASC')->orderBy('name')->paginate(12); 
       $this->filterOptions = $this->subs->keyBy('group_id');
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
        $filter = $request->group;
        $filtered = $this->subs->filter(function ($subs) use ($filter){
            if ($subs->group_id ==  $filter){
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
    public function show($id){
        /**
         * find record using the primary key
         * then pass the data to the edit form
         */
        $record = BlastSubscribers::find($id);

        $old_name = $record->name;
        $old_number = $record->subscriber_number;
        $old_group = $record->group_id;

        return view('user.subscribers.edit', [
            'name' => $old_name,
            'number' => $old_number,
            'group' => $old_group,
            'id' => $record->id
        ]); 
    }
}