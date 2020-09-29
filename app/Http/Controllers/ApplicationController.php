<?php

namespace App\Http\Controllers;

use App\Services\ApplicationService;
use App\Application;
use App\Leavetype;
use App\Employee;
use Illuminate\Http\Request;
use Auth;
use App\User;

class ApplicationController extends Controller
{
    protected $applications;

    public function __construct(ApplicationService $applications){
        $this->applications = $applications;
    }

    public function index()
    {
        if(Auth::user()->hasRole('admin')){
            $applications = $this->applications->all();
            $leaveTypes = $this->applications->getLeaveTypes();
            $employees = $this->applications->getEmployees();
            return view('admin.applications.index',['applications'=>$applications,'leaveTypes'=>$leaveTypes,'employees'=>$employees]);
        }else{
            $employees = Employee::where('id',Auth::user()->id);
            $applications = Application::where('employee_id',Auth::user()->id)->get();
            $leaveTypes = $this->applications->getLeaveTypes();
            return view('users.applications.index',['applications'=>$applications,'leaveTypes'=>$leaveTypes,'employees'=>$employees]);
        }
        
    }

    public function store(Request $request)
    {
        $this->applications->store($request);
        return redirect()->route('applications.index');
    }

    public function edit(Application $application)
    {
        return $application;
    }

    public function update(Request $request, Application $application)
    {
        $this->applications->update($request, $application->id);
        return redirect()->route('applications.index');
    }

    public function destroy(Application $application)
    {
        $this->applications->destroy($application->id);
        return redirect()->route('applications.index');
    }

    // public function delete(Application $application){
    //     $delete = Application::find($application->id);
    //     $delete->delete();
    //     return redirect()->route('applications.index');
    // }
}


