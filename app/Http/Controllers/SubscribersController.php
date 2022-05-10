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
            if ($subs->group_id ==  $filter){
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
        $request->validated();

        $newRecord = new BlastSubscribers();
        $newRecord->name = $request->name;
        $newRecord->subscriber_number = $request->number;
        $newRecord->group_id = $request->group;
        $newRecord->token = Str::random(43);
        $newRecord->save();

        return redirect()->route('dashboard.index');
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
    public function edit($id)
    {
        /**
         * find record using the primary key
         * then pass the data to the edit form
         */
        $record = BlastSubscribers::find($id);

        $old_name = $record->name;
        $old_number = $record->subscriber_number;

        return view('subscribers.edit',[
            'name' => $old_name,
            'number' => $old_number,
            'id' => $record->id
        ]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateSubscriberRequest $request, $id)
    {
        $record = BlastSubscribers::find($id);

        if($record){
            $record->name = $request->name;
            $record->group_id = $request->group;
            $record->subscriber_number = $request->number;
            $record->save();
        }

        // return view('dashboard',[
        //     'subs'=> $this->subsPaginated,
        //     'groups' => $this->filterOptions
        // ]); 
        return redirect()->route('dashboard.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = BlastSubscribers::find($id);
        $record->delete();

        return redirect()->route('dashboard.index');
    }
}
