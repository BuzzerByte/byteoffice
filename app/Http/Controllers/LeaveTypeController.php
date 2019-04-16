<?php

namespace buzzeroffice\Http\Controllers;

use buzzeroffice\LeaveType;
use Illuminate\Http\Request;

class LeaveTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $leavetypes = LeaveType::all();
        return view('admin.leavetypes.index',['leavetypes'=>$leavetypes]);
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
        $store = LeaveType::create([
            'name'=>$request->leave
        ]);
        return redirect()->action('LeaveTypeController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \buzzeroffice\LeaveType  $leaveType
     * @return \Illuminate\Http\Response
     */
    public function show(LeaveType $leaveType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \buzzeroffice\LeaveType  $leaveType
     * @return \Illuminate\Http\Response
     */
    public function edit(LeaveType $leavetype)
    {
        //
        return response()->json($leavetype);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \buzzeroffice\LeaveType  $leaveType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LeaveType $leavetype)
    {
        //
        $update = LeaveType::where('id',$leavetype->id)->update([
            'name'=>$request->leave
        ]);
        return redirect()->action('LeaveTypeController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \buzzeroffice\LeaveType  $leaveType
     * @return \Illuminate\Http\Response
     */
    public function destroy(LeaveType $leaveType)
    {
        //
    }

    public function delete(LeaveType $leavetype){
        $delete = LeaveType::find($leavetype->id);
        $delete->delete(); 
        return redirect()->action('LeaveTypeController@index');
    }
}
