<?php

namespace App\Http\Controllers;

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
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Response;
use Excel;
use File;
use DB;
use Auth;
use App\RoleEmployee;
use App\Role;
use App\Imports\EmployeeImport;
use App\Exports\EmployeeExport;
use App\User;
use App\Services\EmployeeService;

class EmployeeController extends Controller
{
    protected $employees;

    public function __construct(
        EmployeeService $employees
    ){
        $this->employees = $employees;
    }

    public function index()
    {
        if(Auth::user()->hasRole('admin')){
            $employees = $this->employees->all();
            return view('admin.employees.index',['employees'=>$employees]);
        }
        // }else{
        //     $users = User::where('id',Auth::user()->id)->first();
        //     return view('users.profiles.index',['user'=>$users]);
        // }
    }

    public function create()
    {
        $roles = $this->employees->getRoles();
        return view('admin.employees.create',['roles'=>$roles]);
    }


    public function add(Request $request){
        $file_name = $this->employees->avatar($request);
        $employee = $this->employees->store($request, $file_name);
        return redirect()->action('EmployeeController@index');   
    }

    /*
    *Import a list of employees from csv files
    */
    public function import(){
        return view('admin.employees.import');
    }

    public function downloadSample(){
        $result = $this->employees->downloadSample();
        if ($result['file_exists']) {
            flash()->success('File Downloaded');
            return Response::download($result['file_path'], 'employee.csv', $result['headers']);
        } else {
            flash()->error('Something went wrong!');
        }
        return redirect()->route('employees.import');
    }

    public function importEmployee(Request $request){
        $result = $this->clients->import($request);
        if($result['result'] && $result['status']=='success'){
            flash()->success($result['message']);
        }else if($result['result'] && $result['status']=='warning'){
            flash()->warning($result['message']);
        }else{
            flash()->error($result['message']);
        }
        return redirect()->route('employees.index'); 
    }

    public function store(Request $request)
    {
        $file_name = $this->employees->avatar($request);
        $employee = $this->employees->store($request, $file_name);
        //until here
        $role_employee = new RoleEmployee();
        $role_employee->role_id = $request->role;
        $role_employee->employee_id = $employee['employee']->id;
        $role_employee->save();
        return redirect()->route('employees.index');
    }

    public function terminate(Request $request){
        return response()->json($request);
    }

    public function terminateList(){
        $employees = Employee::where('terminate_status',1)->get();
        return view('admin.employees.terminate',['employees'=>$employees]);
    }

    public function show(Employee $employee)
    {   
        // return response()->json($employee);
        $roles = Role::all();
        if(DB::table('employee_attachments')->where('user_id',$employee->id)->exists()){
            $employee_attachments = UserAttachment::where('user_id',$employee->id)->get();
        }else{
            $employee_attachments = null;
        }
        if(Auth::user()->hasRole('admin')){
            return view('admin.employees.show',['employee'=>$employee,'attachments'=>$employee_attachments,'roles'=>$roles]);
        }else{
            return view('users.profiles.index',['user'=>$employee,'attachments'=>$employee_attachments]);
        }
    }

    public function reportTo(Employee $employee){
        if(EmployeeSupervisor::where('employee_id',$employee->id)->exists()){
            $supervisors = EmployeeSupervisor::where('employee_id',$employee->id)->get();
        }else{
            $supervisors = null;
        }

        if(EmployeeSubordinate::where('employee_id',$employee->id)->exists()){
            $subordinates = EmployeeSubordinate::where('employee_id',$employee->id)->get();
        }else{
            $subordinates = null;
        }
        $employees = Employee::all();
        $departments = Department::all();
        
        return view('admin.employeeReportTo.index',[
            'employee'=>$employee,
            'supervisors'=>$supervisors,
            'employees'=>$employees,
            'subordinates'=>$subordinates,
            'departments'=>$departments
        ]);
    }

    public function directDeposit(Employee $employee){
        if(EmployeeDeposit::where('employee_id',$employee->id)->exists()){
            $deposit = EmployeeDeposit::where('employee_id',$employee->id)->first();
        }else{
            $depositId = DB::table('employee_deposits')->insertGetId([
                'employee_id'=>$employee->id,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()
            ]);
            $deposit = EmployeeDeposit::where('id',$depositId)->first();
        }
        return view('admin.employeeDirectDeposit.index',['employee'=>$employee,'deposit'=>$deposit]);
    }

    public function employeeLogin(Employee $employee){
        if(EmployeeLogin::where('employee_id',$employee->id)->exists()){
            $login = EmployeeLogin::where('employee_id',$employee->id)->first();
        }else{
            $loginId = DB::table('employee_logins')->insertGetId([
                'name'=>$employee->f_name,
                'employee_id'=>$employee->id,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()
            ]);
            $login = EmployeeLogin::where('id',$loginId)->first();
        }
        return view('admin.employeeLogins.index',['employee'=>$employee,'login'=>$login]);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        if(Auth::user()->hasRole('admin')){
            if ($request->hasFile('employee_photo')) {
                $image = $request->file('employee_photo');
                $name = $image->getClientOriginalName();
                $destinationPath = public_path('/employeesPhoto');
                $image->move($destinationPath, $name);
            }else{
                $name = NULL;
            }
            $update = Employee::where('id',$employee->id)->update([
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
            $employee = Employee::where('id',$employee->id)->first();

            $delete = RoleEmployee::where('role_id',$request->role);
            $delete->delete();

            $role_employee = new RoleEmployee();
            $role_employee->role_id = $request->role;
            $role_employee->employee_id = $employee->id;
            $role_employee->save();
            return redirect()->route('employees.show',$employee->id);
        }else{
            $update = Employee::where('id',$employee->id)->update([
                'password'  =>bcrypt($request->password),
            ]);
            return redirect()->route('employees.show',$employee->id);
        }  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $delete = Employee::find($employee->id);
        $delete->delete();
        if($delete){
            Session::flash('success', 'Employee Data Deleted!');
        }else{
            Session::flash('failure', 'Something went wrong!');
        }
        return redirect()->route('employees.index');
    }

    public function delete(Employee $employee){
        $delete = Employee::find($employee->id);
        $delete->delete();
        if($delete){
            Session::flash('success', 'Employee Data Deleted!');
        }else{
            Session::flash('failure', 'Something went wrong!');
        }
        return redirect()->route('employees.index');
    }

    public function contactDetails(Employee $employee){
        if(ContactDetail::where('employee_id',$employee->id)->exists()){
            $contactDetailId = ContactDetail::where('employee_id',$employee->id)->first()->id;
        }else{
            $contactDetailId = DB::table('contact_details')->insertGetId(
                ['employee_id'=>$employee->id,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()]
            );
        }
        
        return redirect()->route('contactDetails.show',$contactDetailId);
    }

    public function employeeDependents(Employee $employee){
        if(employeeDependent::where('employee_id',$employee->id)->exists()){
            $dependents = EmployeeDependent::where('employee_id',$employee->id)->get();
        }else{
            $dependents = null;
        }
        return view('admin.employeeDependents.index',['dependents'=>$dependents,'employee'=>$employee]);
    }

    public function employeeCommencements(Employee $employee){
        if(EmployeeCommencement::where('employee_id',$employee->id)->exists()){
            $commencements = EmployeeCommencement::where('employee_id',$employee->id)->first();
        }else{
            $commencementId = DB::table('employee_commencements')->insertGetId([
                'employee_id' => $employee->id, 
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            $commencements = EmployeeCommencement::where('employee_id',$commencementId)->first();
        }
        if(JobHistory::where('employee_id',$employee->id)->exists()){
            $jobHistories = JobHistory::where('employee_id',$employee->id)->get();
        }else{
            $jobHistories = null;
        }
        $departments = Department::all();
        $employeeStatuses = EmployeeStatus::all();
        $jobTitles = JobTitle::all();
        $workShifts = WorkShift::all();
        $jobCategories = JobCategory::all();
        return view('admin.employeeCommencements.index',[
            'employee'=>$employee,
            'commencement'=>$commencements,
            'jobHistories'=>$jobHistories,
            'departments'=>$departments,
            'employeeStatuses'=>$employeeStatuses,
            'jobTitles'=>$jobTitles,
            'workShifts'=>$workShifts,
            'jobCategories'=>$jobCategories
        ]);
    }

    public function employeeSalaries(Employee $employee){
        if(EmployeeSalary::where('employee_id',$employee->id)->exists()){
            $salary = EmployeeSalary::where('employee_id',$employee->id)->first();
        }else{
            $salaryId = DB::table('employee_salaries')->insertGetId([
                'employee_id'=> $employee->id,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()
            ]);
            $salary = EmployeeSalary::where('id',$salaryId)->first();
        }
        return view('admin.employeeSalaries.index',['employee'=>$employee,'salary'=>$salary]);
    }
}
