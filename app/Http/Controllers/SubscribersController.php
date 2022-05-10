<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlastSubscribers;
use App\Http\Requests\CreateSubscriberRequest;
use Illuminate\Support\Str;

class SubscribersController extends Controller
{
    /**
     * collection of subscribers to be used
     * in app
     */
    private $subs;
    private $filterOptions;
    private $subsPaginated;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Add the subs collection with pagination
     * upon calling the controller
     */
    public function __construct()
    {
       $this->subs = BlastSubscribers::orderBy('GROUP_ID', 'ASC')->get(); 
       $this->subsPaginated = BlastSubscribers::orderBy('GROUP_ID', 'ASC')->paginate(12); 
       $this->filterOptions = $this->subs->keyBy('GROUP_ID');
    }

    /**
     * Returns the unfiltered collection 
     * for dashboard view
     */
    public function index()
    {
        //
        // dd($this->subs->keyBy('GROUP_ID'));
        return view('dashboard',[
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
            if ($subs->GROUP_ID ==  $filter){
                return true;
            }
        });

        return view('dashboard', [
            'subs' => $filtered,
            'groups' => $this->filterOptions,
            'filter' => $filter
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('subscribers.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSubscriberRequest $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'number' => 'required|numeric|digits:11',
            'group' => 'required'
        ]);

        $newRecord = new BlastSubscribers();
        $newRecord->NAME = $request->name;
        $newRecord->SUBSCRIBER_NUMBER = $request->number;
        $newRecord->GROUP_ID = $request->group;
        $newRecord->TOKEN = Str::random(43);
        $newRecord->save();

        return view('dashboard',[
            'subs'=> $this->subsPaginated,
            'groups' => $this->filterOptions
        ]); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($group, $name)
    {
        $old_name = null;
        $old_number = null;
        $records = $this->subs->where('NAME', $name)->where('GROUP_ID', $group);

        foreach ($records as $record) {
            $old_name = $record->NAME;
            $old_number = $record->SUBSCRIBER_NUMBER;
        }

        return view('subscribers.edit',[
            // 'record' => $record,
            'name' => $old_name,
            'number' => $old_number,
            'group' => $group
        ]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateSubscriberRequest $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'number' => 'required|numeric|digits:11',
            'group' => 'required'
        ]);

        $old_record = BlastSubscribers::where('NAME', $request->name);
        dd($old_record->GROUP_ID);

        // $record = $this->subs->firstOrFail(function ($subs) use ($request){
        //     if ($subs->NAME ==  $request->name && $subs->GROUP_ID ==  $request->group){
        //         return true;
        //     }
        // });
        // $record->NAME = $request->name;
        // $record->SUBSCRIBER_NUMBER = $request->number;
        // $record->GROUP_ID = $request->group;
        // $record->save();

        // $subscribers->update([
        //     'NAME' => $request->name,
        //     'GROUP_ID' => $request->group,
        //     'SUBSCRIBER_NUMBER' => $request->number
        // ]);

        return view('dashboard',[
            'subs'=> $this->subsPaginated,
            'groups' => $this->filterOptions
        ]); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
