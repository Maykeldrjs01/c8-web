<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlastSubscribers;

class SubscribersController extends Controller
{
    private $subs;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
       $this->subs = BlastSubscribers::paginate(10); 
    }

    public function index()
    {
        //
        return view('dashboard',[
            'subs'=> $this->subs,
        ]); 
    }

    public function filters($string)
    {
        $filtered = $this->subs->filter(function ($subs) use ($string){
            if ($subs->GROUP_ID === $string){
                return true;
            }
        });

        return view('dashboard', [
            'subs' => $filtered
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
