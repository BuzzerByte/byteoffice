<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;
use App\Employee;
use App\UserAttachment;
use App\ContactDetail;
use App\EmployeeDependent;
use App\EmployeeCommencement;
use App\JobHistory;
use App\EmployeeSalary;
use App\EmployeeSupervisor;
use App\EmployeeSubordinate;
use App\EmployeeDeposit;
use App\EmployeeLogin;
use App\Department;
use App\EmployeeStatus;
use App\JobCategory;
use App\JobTitle;
use App\WorkShift;
use App\Attendance;
use App\Role;
use App\RoleUser;
use Carbon\Carbon;
use App\Imports\EmployeeImport;
use App\Exports\EmployeeExport;
use Session;
use Response;
use Excel;
use File;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasRole('admin')){
            $employees = User::where('terminate_status',0)->get();
            return view('admin.employees.index',['employees'=>$employees]);
        }else{
            $users = User::where('id',Auth::user()->id)->first();
            
            return view('users.profiles.index',['user'=>$users]);
        }
    }

    public function storeSkin(Request $request){
        $userId = Auth::user()->id;
        
        $updateSkin = User::where('id',1)->update([
            'skin'=>$request->bodySkin
        ]);

        if($updateSkin){
            return response()->json($userId);
        }else{
            return response()->json($userId);
        }
        
    }

    public function getSkin(){
        $userId = Auth::user()->id;
        $skin = User::select('skin')->where('id',$userId)->first()->skin;
        return response()->json($skin);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.employees.create',['roles'=>$roles]);
    }

    public function add(Request $request){
        
    }

    /*
    *Import a list of employees from csv files
    */
    public function import(){
        return view('admin.employees.import');
    }

    public function downloadEmployeeSample(){
        $file_path = storage_path() . "/app/downloads/employee.csv";
        $headers = array(
            'Content-Type: csv',
            'Content-Disposition: attachment; filename=employee.csv',
        );
        if (file_exists($file_path)) {
            flash()->success('File Downloaded');
            return Response::download($file_path, 'employee.csv', $headers);
        } else {
            flash()->error('Something went wrong!');
        }
        
        return redirect()->route('users.import');
    }

    public function importEmployee(Request $request){
        $employee_id = [];
        if ($request->hasFile('importEmployee')) {
            $extension = File::extension($request->importEmployee->getClientOriginalName());
            if ($extension == "csv") {
                $path = $request->importEmployee->getRealPath();
                // Excel::import(new ClientsImport, $request->import_file);
                $data = Excel::import(new EmployeeImport, $request->importEmployee);
                if(!empty($data)){
                    foreach($data as $record){
                        if(in_array($record->id_number,$employee_id)){
                            continue;   
                        }else if(User::where('id_number','=',$record->id_number)->exists()){
                            continue;
                        }else{
                            $employee_id[] = $record->id_number;
                            $record->dob = date('Y-m-d');
                            $insert_employee_data[] = [
                                'name'   => $record->first_name." ".$record->last_name,
                                'email'  => $record->email,
                                'f_name' => $record->first_name,
                                'l_name' => $record->last_name,
                                'marital_status'=>$record->marital_status,
                                'dob' => $record->dob,
                                'id_number' => $record->id_number,
                                'gender'=> $record->gender,
                                'country'=>'-',
                                'blood_group'=>'-',
                                'religious'=>'-',
                                'terminate_status'=>0
                            ];
                        }
                    }
                    if(!empty($insert_employee_data)){
                        $insert_employee = DB::table('users')->insert($insert_employee_data);
                        // Session::flash('success', 'Employees Data Imported!');
                        flash()->success('Employees Data Imported');
                    }else{
                        // Session::flash('warning', 'Duplicated record, please check your csv file!');
                        flash()->warning('Duplicated record, please check your csv file!');
                    }
                }else{
                    // Session::flash('warning', 'There is no data in csv file!');
                    flash()->warning('There is no data in csv file!');
                }
            }else{
                // Session::flash('warning', 'Selected file is not csv!');
                flash()->warning('Selected file is not csv!');
            }
        }else{
            // Session::flash('failure', 'Something went wrong!');
            flash()->error('Something went wrong!');
        }
        return redirect()->route('users.index'); 
    }

    public function export(){
        return (new EmployeeExport)->download('employee.csv');
    }

    public function terminate(Request $request){
        return response()->json($request);
    }

    public function terminateList(){
        $employees = User::where('terminate_status',1)->get();
        return view('admin.employees.terminate',['employees'=>$employees]);
    }

    public function show(User $user)
    {   
        $roles = Role::all();
        if(DB::table('user_attachments')->where('user_id',$user->id)->exists()){
            $user_attachments = UserAttachment::where('user_id',$user->id)->get();
        }else{
            $user_attachments = null;
        }
        if(Auth::user()->hasRole('admin')){
            return view('admin.employees.show',['employee'=>$user,'attachments'=>$user_attachments,'roles'=>$roles]);
        }else{
            return view('users.profiles.index',['user'=>$user,'attachments'=>$user_attachments]);
        }
    }

    public function contactDetails(User $user){
        if(ContactDetail::where('employee_id',$user->id)->exists()){
            $contactDetailId = ContactDetail::where('employee_id',$user->id)->first()->id;
        }else{
            $contactDetailId = DB::table('contact_details')->insertGetId(
                ['employee_id'=>$user->id,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()]
            );
        }
        
        return redirect()->route('contactDetails.show',$contactDetailId);
    }

    public function employeeDependents(User $user){
        if(employeeDependent::where('employee_id',$user->id)->exists()){
            $dependents = EmployeeDependent::where('employee_id',$user->id)->get();
        }else{
            $dependents = null;
        }
        return view('admin.employeeDependents.index',['dependents'=>$dependents,'employee'=>$user]);
    }

    public function employeeCommencements(User $user){
        if(EmployeeCommencement::where('employee_id',$user->id)->exists()){
            $commencements = EmployeeCommencement::where('employee_id',$user->id)->first();
        }else{
            $commencementId = DB::table('employee_commencements')->insertGetId([
                'employee_id' => $user->id, 
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            $commencements = EmployeeCommencement::where('employee_id',$commencementId)->first();
        }
        if(JobHistory::where('employee_id',$user->id)->exists()){
            $jobHistories = JobHistory::where('employee_id',$user->id)->get();
        }else{
            $jobHistories = null;
        }
        $departments = Department::all();
        $employeeStatuses = EmployeeStatus::all();
        $jobTitles = JobTitle::all();
        $workShifts = WorkShift::all();
        $jobCategories = JobCategory::all();
        return view('admin.employeeCommencements.index',[
            'employee'=>$user,
            'commencement'=>$commencements,
            'jobHistories'=>$jobHistories,
            'departments'=>$departments,
            'employeeStatuses'=>$employeeStatuses,
            'jobTitles'=>$jobTitles,
            'workShifts'=>$workShifts,
            'jobCategories'=>$jobCategories
        ]);
    }

    public function employeeSalaries(User $user){
        if(EmployeeSalary::where('employee_id',$user->id)->exists()){
            $salary = EmployeeSalary::where('employee_id',$user->id)->first();
        }else{
            $salaryId = DB::table('employee_salaries')->insertGetId([
                'employee_id'=> $user->id,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()
            ]);
            $salary = EmployeeSalary::where('id',$salaryId)->first();
        }
        return view('admin.employeeSalaries.index',['employee'=>$user,'salary'=>$salary]);
    }

    public function reportTo(User $user){
        if(EmployeeSupervisor::where('employee_id',$user->id)->exists()){
            $supervisors = EmployeeSupervisor::where('employee_id',$user->id)->get();
        }else{
            $supervisors = null;
        }

        if(EmployeeSubordinate::where('employee_id',$user->id)->exists()){
            $subordinates = EmployeeSubordinate::where('employee_id',$user->id)->get();
        }else{
            $subordinates = null;
        }
        $employees = User::all();
        $departments = Department::all();
        
        return view('admin.employeeReportTo.index',[
            'employee'=>$user,
            'supervisors'=>$supervisors,
            'employees'=>$employees,
            'subordinates'=>$subordinates,
            'departments'=>$departments
        ]);
    }

    public function directDeposit(User $user){
        if(EmployeeDeposit::where('employee_id',$user->id)->exists()){
            $deposit = EmployeeDeposit::where('employee_id',$user->id)->first();
        }else{
            $depositId = DB::table('employee_deposits')->insertGetId([
                'employee_id'=>$user->id,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()
            ]);
            $deposit = EmployeeDeposit::where('id',$depositId)->first();
        }
        return view('admin.employeeDirectDeposit.index',['employee'=>$user,'deposit'=>$deposit]);
    }

    public function employeeLogin(User $user){

        if(EmployeeLogin::where('employee_id',$user->id)->exists()){
            $login = EmployeeLogin::where('employee_id',$user->id)->first();
        }else{
            $loginId = DB::table('employee_logins')->insertGetId([
                'name'=>$user->f_name,
                'employee_id'=>$user->id,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()
            ]);
            $login = EmployeeLogin::where('id',$loginId)->first();
        }
        return view('admin.employeeLogins.index',['employee'=>$user,'login'=>$login]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('employee_photo')) {
            $image = $request->file('employee_photo');
            $name = $image->getClientOriginalName();
            $destinationPath = public_path('/employeesPhoto');
            $image->move($destinationPath, $name);
        }else{
            $name = NULL;
        }
        $store = DB::table('users')->insertGetId([
            'name'  =>$request->first_name." ".$request->last_name,
            'email' =>$request->email,
            'f_name'=>$request->first_name,
            'l_name'=>$request->last_name,
            'dob'=>$request->date_of_birth,
            'marital_status'=>$request->marital_status,
            'country'=>$request->country,
            'blood_group'=>$request->blood_group,
            'id_number'=>$request->id_number,
            'religious'=>$request->religious,
            'gender'=>$request->gender,
            'photo'=>$name,
            'terminate_status'=>0,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
        ]);
        $user = User::where('id',$store)->first();
        //default is user

        // return response()->json($request->role);
        // $user->attachRole($request->role);//role_ id

        $role_user = new RoleUser();
        $role_user->role_id = $request->role;
        $role_user->user_id = $user->id;
        $role_user->save();

        return redirect()->route('users.index');   
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
        if(Auth::user()->hasRole('admin')){
            if ($request->hasFile('employee_photo')) {
                $image = $request->file('employee_photo');
                $name = $image->getClientOriginalName();
                $destinationPath = public_path('/employeesPhoto');
                $image->move($destinationPath, $name);
            }else{
                $name = NULL;
            }
            $update = User::where('id',$user->id)->update([
                'name'  =>$request->first_name." ".$request->last_name,
                'email' =>$request->email,
                'f_name'=>$request->first_name,
                'l_name'=>$request->last_name,
                'dob'   =>$request->date_of_birth,
                'marital_status'=>$request->marital_status,
                'country'=>$request->country,
                'blood_group'=>$request->blood_group,
                'id_number'=>$request->id_number,
                'religious'=>$request->religious,
                'gender'=>$request->gender,
                'photo'=>$name,
                'updated_at'=>Carbon::now()
            ]);
            $user = User::where('id',$user->id)->first();
            
            // $user->roles()->sync($request->role);
            $role_user = new RoleUser();
            $role_user->role_id = $request->role;
            $role_user->user_id = $user->id;
            $role_user->save();
            return redirect()->route('users.show',$user->id);
        }else{
            $update = User::where('id',$user->id)->update([
                'password'  =>bcrypt($request->password),
            ]);
            return redirect()->route('users.show',$user->id);
        }  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        $delete = User::find($user->id);
        $delete->delete();
        if($delete){
            // Session::flash('success', 'Employee Data Deleted!');
            flash()->success('Employee Data Deleted!');
        }else{
            // Session::flash('failure', 'Something went wrong!');
            flash()->error('Something went wrong!');
        }
        return redirect()->action(
            'UserController@index'
        );
    }

    public function delete(User $user){
        $delete = User::find($user->id);
        $delete->delete();
        if($delete){
            // Session::flash('success', 'Employee Data Deleted!');
            flash()->success('Employee Data Deleted!');
        }else{
            // Session::flash('failure', 'Something went wrong!');
            flash()->error('Something went wrong!');
        }
        return redirect()->action(
            'UserController@index'
        );
    }

    public function showAttendances(User $user, Request $request){
        $year = $request->year;
        $januaryds = 0; $februaryds=0; $marchds = 0; $aprilds=0; $mayds=0; $juneds=0; $julyds=0; $augustds=0; $septemberds=0; $octoberds=0; $novemberds=0; $decemberds=0;
        $monthArr = [$januaryds, $februaryds, $marchds, $aprilds, $mayds, $juneds, $julyds, $augustds, $septemberds, $octoberds, $novemberds, $decemberds];
        for($i=1; $i<=12; $i++){
            $date = Carbon::parse($year.'-'.$i);
            $monthArr[$i-1] = $date->daysInMonth;
        }
       
        if($request == null || $request == ""){
            $attendances = null;
            $user_id     = Auth::user()->id;
            return view('users.attendances.showAttendances',['attendances'=>$attendances,'id'=>$user_id,'year'=>$year,'month'=>$monthArr]);
        }else{
            $attendances = Attendance::whereYear('date',$year)->where('employee_id',Auth::user()->id)->get();
            $user_id     = Auth::user()->id;
            // return response()->json($user_id);
            return view('users.attendances.showAttendances',['attendances'=>$attendances,'id'=>$user_id,'year'=>$year,'month'=>$monthArr]);
        }
    }

    public function setAttendanceYear(Request $request){
        
        $year = Carbon::parse($request->date)->format('Y');
       
        return redirect()->route('profiles.showAttendances',['year'=>$year]);
    }
}
