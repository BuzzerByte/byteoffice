<?php

namespace buzzeroffice\Http\Controllers;

use buzzeroffice\Application;
use buzzeroffice\Leavetype;
use buzzeroffice\Employee;
use Illuminate\Http\Request;
use Auth;
use buzzeroffice\User;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasRole('admin')){
            $applications = Application::all();
            $leaveTypes = Leavetype::all(); 
            $employees = User::all();
            return view('admin.applications.index',['applications'=>$applications,'leaveTypes'=>$leaveTypes,'employees'=>$employees]);
        }else{
            $employees = User::where('id',Auth::user()->id);
            $applications = Application::where('employee_id',Auth::user()->id)->get();
            $leaveTypes = Leavetype::all(); 
            return view('users.applications.index',['applications'=>$applications,'leaveTypes'=>$leaveTypes,'employees'=>$employees]);
        }
        
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
        if(Auth::user()->hasRole('admin')){
            $store = Application::create([
                'employee_id'=>$request->employee,
                'start'=>$request->start,
                'end'=>$request->end,
                'type_id'=>(int)$request->type,
                'date'=>$request->apply,
                'status'=> 'pending'   
            ]);
        }else{
            $store = Application::create([
                'employee_id'=>Auth::user()->id,
                'reason' =>$request->reason,
                'start'=>$request->start,
                'end'=>$request->end,
                'type_id'=>(int)$request->type,
                'date'=>$request->apply,
                'status'=> 'pending'   
            ]);
        }
        return redirect()->action('ApplicationController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \buzzeroffice\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function show(Application $application)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \buzzeroffice\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function edit(Application $application)
    {
        return $application;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \buzzeroffice\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Application $application)
    {
        $update = Application::where('id',$application->id)->update([
            'employee_id'=>$request->employee,
            'start'=>$request->start,
            'end'=>$request->end,
            'type_id'=>(int)$request->type,
            'date'=>$request->apply,
            'status'=> $request->status
        ]);
        return redirect()->action('ApplicationController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \buzzeroffice\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function destroy(Application $application)
    {
        //
    }

    public function delete(Application $application){
        $delete = Application::find($application->id);
        $delete->delete();
        return redirect()->action('ApplicationController@index');
    }
}


