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
            if ($subs->group_id ==  $filter){
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
        $newRecord->name = $request->name;
        $newRecord->subscriber_number = $request->number;
        $newRecord->group_id = $request->group;
        $newRecord->token = Str::random(43);
        $newRecord->save();

        return redirect()->route('admin.dashboard.index')->with('toast_success', 'Subscriber added successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
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
        $old_group = $record->group_id;

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
            $record->name = $request->name;
            $record->group_id = $request->group;
            $record->subscriber_number = $request->number;
            $record->save();
        }

        return redirect()->route('admin.dashboard.index')->with('toast_success', 'Subscriber updated successfully!') ;
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy($id)
    {
        $record = BlastSubscribers::find($id);
        $record->delete();

        return redirect()->route('admin.dashboard.index')->with('toast_success', 'Subscriber removed successfully!') ;
    }
}
