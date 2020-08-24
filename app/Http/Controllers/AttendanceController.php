<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Department;
use App\Employee;
use App\JobHistory;
use App\LeaveType;
use App\User;
use Carbon\Carbon;
use Session;
use Response;
use File;
use Excel;
use Illuminate\Http\Request;
use Auth;
use App\Imports\AttendanceImport;
use App\Exports\AttendanceExport;

class AttendanceController extends Controller
{
    public function index()
    {
        //
        if(Auth::user()->hasRole('admin')){
            $departments = Department::all();
            return view('admin.attendances.index',['departments'=>$departments]);
        }else{
            $departments = Department::all();
            $user_id     = Auth::user()->id;
            $attendances = null;
            return view('users.attendances.index',['departments'=>$departments,'id'=>$user_id,'attendances'=>$attendances]);
        }
    }

    public function setAttendance(Request $request){
        $department_id = (int)$request->department;
        $attendances = Attendance::where('department_id',$request->department)->where('date',$request->date)->get();
        $departments = Department::all();
        $leave = LeaveType::all();

        return view('admin.attendances.setAttendance',[
            'attendances'=>$attendances,
            'date'=>$request->date,
            'department_id'=>$department_id,
            'departments'=>$departments,
            'leave' => $leave
        ]);
    }

    public function import(){
        $employees = Employee::all();
        return view('admin.attendances.import',['employees'=>$employees]);
    }

    public function download(){
        // Check if file exists in app/storage/file folder
        $file_path = storage_path() . "/app/downloads/attendance.csv";
        $headers = array(
            'Content-Type: csv',
            'Content-Disposition: attachment; filename=attendance.csv',
        );
        if (file_exists($file_path)) {
            // Send Download
            Session::flash('success', 'File Downloaded');
            return Response::download($file_path, 'attendance.csv', $headers);
        } else {
            // Error
            Session::flash('failure', 'Something went wrong!');
        }
        $employees = Employee::all();
        return view('admin.attendances.import',['employees'=>$employees]);
    }

    public function importAttendance(Request $request){
        $employee_id = [];
        if ($request->hasFile('importAttendance')) {
            $extension = File::extension($request->importAttendance->getClientOriginalName());
            if ($extension == "csv") {
                $path = $request->importAttendance->getRealPath();
                $data = Excel::import(new AttendanceImport, $request->importAttendance);
                if(!empty($data)){
                    foreach($data as $record){
                        Attendance::updateOrCreate(
                            [
                                'date'=>Carbon::parse($record->date)->format('Y-m-d'),
                                'employee_id'=>Employee::select('id_number')->where('id_number',$record->employee_id)->first()->id_number,
                                'department_id' => Department::select('id')->where('name',$record->deparment)->first()->id,
                                'leave_id'=> $record->leave_id,
                            ],[
                                'in'=>Carbon::parse($record->in_time)->format('H:i'),
                                'out'=>Carbon::parse($record->out_time)->format('H:i'),
                            ]
                        );
                    }
                    
                }else{
                    Session::flash('warning', 'There is no data in csv file!');
                }
            }else{
                Session::flash('warning', 'Selected file is not csv!');
            }
        }else{
            Session::flash('failure', 'Something went wrong!');
        }
        return redirect()->route('employees.index'); 
    }


    public function updateAttendance(Request $request){
        $department_id = (int)$request->department;
        $date = Carbon::parse($request->date)->format('Y-m-d');
        $update_lenght = count($request->employee_id);
        $employee = $request->employee_id;
        $leave_type = $request->leave_category_id;
        $in = $request->in;
        $out = $request->out;
        for($i = 0; $i< $update_lenght; $i++){
            $update = Attendance::where('date',$date)
                                ->where('department_id',(int)$department_id)
                                ->where('employee_id',(int)$employee[$i])
                                ->update([
                'leave_id'=> (int)$leave_type[$i],
                'in' => Carbon::parse($in[$i])->format('H:i'),
                'out' => Carbon::parse($out[$i])->format('H:i')
            ]);
        }
        $attendances = Attendance::where('department_id',$request->department)->where('date',$request->date)->get();
        $departments = Department::all();
        $leave = LeaveType::all();
        return redirect()->route('attendances.setAttendance',[
            'attendances'=>$attendances,
            'department'=>$request->department,
            'date'=>$date,
            'departments'=>$departments,
            'leave' => $leave
        ]);
        
    }

    public function store(Request $request)
    {
        $department_id = $request->department_id;
        $date = Carbon::parse($request->date)->format('Y-m-d');
        if(JobHistory::where('department_id',$department_id)->exists()){
            $department_id_arr = JobHistory::select('employee_id')->where('department_id',$department_id)->get();
            $employees = [];
            foreach($department_id_arr as $id){
                $employee = Employee::where('id',$id['employee_id'])->first();
                array_push($employees,$employee);
                $store = Attendance::updateOrCreate(
                    [
                        'employee_id'  =>$id['employee_id'],
                        'date'=>$date
                    ],[
                        'department_id'=>$department_id,
                    ]
                );
            }     
            $departments = Department::all();
            $department = Department::where('id',$department_id)->first();
            return redirect()->route('attendances.setAttendance',['department'=>$department,'date'=>$date]);
        }else{
            $department_id_arr = null;
            return redirect()->route('attendances.index');
        }
    }

    public function attendanceReport(Request $request){
        $departments = Department::all();
        $date = Carbon::parse($request->month);
        $month = Carbon::parse($request->month)->format('m');
        $year = Carbon::parse($request->month)->format('Y');
        if($request == null || $request == ""){
            $attendances = null;
            return view('admin.attendances.report',['departments'=>$departments,'attendances'=>$attendances]);
        }else{
            $attendances = Attendance::whereMonth('date',$month)->whereYear('date',$year)->where('department_id',$request->department_id)->get();
            $numberOfDays = $date->daysInMonth;
            $employees = JobHistory::select('employee_id')->where('department_id',$request->department_id)->get();
            $employee_attendance = array();
            foreach($employees as $employee){
                foreach($attendances as $attendance){
                    if($employee->employee_id == $attendance->employee_id){
                        array_push($employee_attendance, $attendance);
                    }
                }
            }
            return view('admin.attendances.report',['departments'=>$departments,'attendances'=>$attendances,'numberOfDays'=>$numberOfDays,'employees'=>$employees,'employee_attendances'=>$employee_attendance]);
        }
    }

    public function setReport(Request $request){
        $month = Carbon::parse($request->date)->format('Y-m-d');
        $department_id = $request->department_id;
        return redirect()->route('attendances.attendanceReport',['month'=>$month,'department_id'=>$department_id]);
    }

    public function edit(Attendance $attendance)
    {
        //
        return view('admin.attendances.edit',['employees'=>$employees,'department'=>$department,'date'=>$date]);
    }

    public function export(){
        return (new AttendanceExport)->download('attendance.csv');
    }
}
