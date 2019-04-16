<?php

namespace buzzeroffice\Http\Controllers;

use buzzeroffice\WorkingDay;
use Illuminate\Http\Request;

class WorkingDayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $working = WorkingDay::all();   
        // return response()->json($working);
        return view('admin.workingdays.index',['work'=>$working]);
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
        if($request->working_days == null){
            //add session at last
            return redirect()->action('WorkingDayController@index');
        }
        $working_days_arr = $request->working_days;
        $days_arr = $request->days;
        $enable_arr = [0,0,0,0,0,0,0];
        $day_name = ['saturday','sunday','monday','tuesday','wednesday','thursday','friday'];
        
        foreach($days_arr as $index => $day){
            foreach($working_days_arr as $w_day){
                if($w_day == $day){
                    $enable_arr[$index] = 1;
                    break;
                }else{
                    continue;
                }
            }
        }

        foreach($day_name as $index=>$name){
            WorkingDay::updateOrCreate(
                ['day' => $day_name[$index]],
                ['work'=>$enable_arr[$index]]
            );
        }
        return redirect()->action('WorkingDayController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \buzzeroffice\WorkingDay  $workingDay
     * @return \Illuminate\Http\Response
     */
    public function show(WorkingDay $workingDay)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \buzzeroffice\WorkingDay  $workingDay
     * @return \Illuminate\Http\Response
     */
    public function edit(WorkingDay $workingDay)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \buzzeroffice\WorkingDay  $workingDay
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WorkingDay $workingDay)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \buzzeroffice\WorkingDay  $workingDay
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkingDay $workingDay)
    {
        //
    }
}
