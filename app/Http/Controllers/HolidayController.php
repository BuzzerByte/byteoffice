<?php

namespace App\Http\Controllers;

use App\Holiday;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $holidays = Holiday::all();
        return view('admin.holidays.index',['holidays'=>$holidays]);
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
        $store = Holiday::create([
            'name' => $request->event_name,
            'description'=>$request->description,
            'start' => $request->start_date,
            'end'=>$request->end_date
        ]);
        return redirect()->action('HolidayController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Holiday  $holiday
     * @return \Illuminate\Http\Response
     */
    public function show(Holiday $holiday)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Holiday  $holiday
     * @return \Illuminate\Http\Response
     */
    public function edit(Holiday $holiday)
    {
        //
        return response()->json($holiday);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Holiday  $holiday
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Holiday $holiday)
    {
        //
        $update = Holiday::where('id',$holiday->id)->update([
            'name'=>$request->event_name,
            'description'=>$request->description,
            'start'=>$request->start_date,
            'end'=>$request->end_date
        ]);
        return redirect()->action('HolidayController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Holiday  $holiday
     * @return \Illuminate\Http\Response
     */
    public function destroy(Holiday $holiday)
    {
        //
    }

    public function delete(Holiday $holiday){
        $delete = Holiday::find($holiday->id);
        $delete->delete();
        return redirect()->action('HolidayController@index');
    }
}
