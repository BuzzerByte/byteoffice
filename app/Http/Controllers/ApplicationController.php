<?php

namespace App\Http\Controllers;

use App\Application;
use App\Leavetype;
use App\Employee;
use Illuminate\Http\Request;
use Auth;
use App\User;

class ApplicationController extends Controller
{
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

    public function edit(Application $application)
    {
        return $application;
    }

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


