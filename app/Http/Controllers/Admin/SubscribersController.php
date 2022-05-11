<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlastSubscribers;
use App\Http\Requests\CreateSubscriberRequest;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
class SubscribersController extends Controller
{
    private $subs;
    private $filterOptions;
    private $subsPaginated;

    public function __construct()
    {
       $this->subs = BlastSubscribers::orderBy('GROUP_ID', 'ASC')->get(); 
       $this->subsPaginated = BlastSubscribers::orderBy('GROUP_ID', 'ASC')->orderBy('name')->paginate(12); 
       $this->filterOptions = $this->subs->keyBy('GROUP_ID');
    }

    /**
     * Returns the unfiltered collection 
     * for dashboard view
     */
    public function index()
    {
        return view('admin.dashboard',[
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
        Alert::toast('Filter applied!', 'info');
        return view('admin.dashboard', [
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
        return view('admin.subscribers.index');
    }

   /**
     * Store a newly created resource in storage.
     *
     */
    public function store(CreateSubscriberRequest $request)
    {

        $newRecord = new BlastSubscribers();
        $newRecord->NAME = $request->name;
        $newRecord->SUBSCRIBER_NUMBER = $request->number;
        $newRecord->GROUP_ID = $request->group;
        $newRecord->TOKEN = Str::random(43);
        $newRecord->save();

        return redirect()->route('admin.dashboard.index')->with('toast_success', 'Subscriber added successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit(Request $request)
    {
        /**
         * find record using the primary key
         * then pass the data to the edit form
         */
        $record = BlastSubscribers::where('NAME', $request->name)->where('GROUP_ID', $request->group_id)->first();

        $old_name = $record->NAME;
        $old_number = $record->SUBSCRIBER_NUMBER;
        $old_group = $record->GROUP_ID;

        return view('admin.subscribers.edit',[
            'name' => $old_name,
            'number' => $old_number,
            'group' => $old_group,
            'id' => $record->id
        ]); 
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(CreateSubscriberRequest $request, $id)
    {
        $record = BlastSubscribers::find($id);

        if($record){
            $record->NAME = $request->name;
            $record->GROUP_ID = $request->group;
            $record->SUBSCRIBER_NUMBER = $request->number;
            $record->save();
        }

        return redirect()->route('admin.dashboard.index')->with('toast_success', 'Subscriber updated successfully!') ;
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(Request $request)
    {
        $record = BlastSubscribers::where('NAME', $request->name)->where('GROUP_ID', $request->group_id)->first();
        $record->delete();

        return redirect()->route('admin.dashboard.index')->with('toast_success', 'Subscriber removed successfully!') ;
    }
}
