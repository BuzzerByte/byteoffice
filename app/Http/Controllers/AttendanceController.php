<?php

namespace buzzeroffice\Http\Controllers;

use buzzeroffice\Attendance;
use buzzeroffice\Department;
use buzzeroffice\Employee;
use buzzeroffice\JobHistory;
use buzzeroffice\LeaveType;
use buzzeroffice\User;
use Carbon\Carbon;
use Session;
use Response;
use File;
use Excel;
use Illuminate\Http\Request;
use Auth;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $employees = User::all();
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
        $employees = User::all();
        return view('admin.attendances.import',['employees'=>$employees]);
    }

    public function importAttendance(Request $request){
        $employee_id = [];
        if ($request->hasFile('importAttendance')) {
            $extension = File::extension($request->importAttendance->getClientOriginalName());
            if ($extension == "csv") {
                $path = $request->importAttendance->getRealPath();
                $data = Excel::load($path, function($reader) {})->get();
                if(!empty($data) && $data->count()){
                    foreach($data as $record){
                        $department_id = JobHistory::where('employee_id',User::where('id_number',$record->employee_id)->first()->id)->first()->department_id;
                        Attendance::updateOrCreate(
                            [
                                'date'=>Carbon::parse($record->date)->format('Y-m-d'),
                                'employee_id'=>User::where('id_number',$record->employee_id)->first()->id,
                                'department_id' => $department_id
                            ],[
                                'in'=>$record->in_time,
                                'out'=>$record->out_time,
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
        return redirect()->action('UserController@index'); 
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $department_id = $request->department_id;
        $date = Carbon::parse($request->date)->format('Y-m-d');
        if(JobHistory::where('department_id',$department_id)->exists()){
            $department_id_arr = JobHistory::select('employee_id')->where('department_id',$department_id)->get();
            $employees = [];
            foreach($department_id_arr as $id){
                $employee = User::where('id',$id['employee_id'])->first();
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
            return redirect()->action('AttendanceController@setAttendance',['department'=>$department,'date'=>$date]);
        }else{
            $department_id_arr = null;
            return redirect()->action('AttendanceController@index');
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
    /**
     * Display the specified resource.
     *
     * @param  \buzzeroffice\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance $attendance)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \buzzeroffice\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendance $attendance)
    {
        //
        return view('admin.attendances.edit',['employees'=>$employees,'department'=>$department,'date'=>$date]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \buzzeroffice\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attendance $attendance)
    {
        //
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \buzzeroffice\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        //
    }
}
