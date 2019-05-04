<?php

namespace buzzeroffice\Http\Controllers;

use buzzeroffice\Employee;
use buzzeroffice\UserAttachment;
use buzzeroffice\ContactDetail;
use buzzeroffice\EmployeeDependent;
use buzzeroffice\EmployeeCommencement;
use buzzeroffice\JobHistory;
use buzzeroffice\EmployeeSalary;
use buzzeroffice\EmployeeSupervisor;
use buzzeroffice\EmployeeSubordinate;
use buzzeroffice\EmployeeDeposit;
use buzzeroffice\EmployeeLogin;
use buzzeroffice\Department;
use buzzeroffice\EmployeeStatus;
use buzzeroffice\JobCategory;
use buzzeroffice\JobTitle;
use buzzeroffice\WorkShift;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Response;
use Excel;
use File;
use DB;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::where('terminate_status',false)->get();
        return view('admin.employees.index',['employees'=>$employees]);
    }

    public function create()
    {
        return view('admin.employees.create');
    }


    public function add(Request $request){
        if ($request->hasFile('employee_photo')) {
            $image = $request->file('employee_photo');
            $name = $image->getClientOriginalName();
            $destinationPath = public_path('/employeesPhoto');
            $image->move($destinationPath, $name);
        }else{
            $name = NULL;
        }
        $store = Employee::create([
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
            'terminate_status'=>0
        ]);
        return redirect()->action('EmployeeController@index');   }

    public function import(){
        return view('admin.employees.import');
    }

    public function downloadEmployeeSample(){
        // Check if file exists in app/storage/file folder
        $file_path = storage_path() . "/app/downloads/employee.csv";
        $headers = array(
            'Content-Type: csv',
            'Content-Disposition: attachment; filename=employee.csv',
        );
        if (file_exists($file_path)) {
            // Send Download
            Session::flash('success', 'File Downloaded');
            return Response::download($file_path, 'employee.csv', $headers);
        } else {
            // Error
            Session::flash('failure', 'Something went wrong!');
        }
        return redirect()->route('employees.import');
    }

    public function importEmployee(Request $request){
        $employee_id = [];
        if ($request->hasFile('importEmployee')) {
            $extension = File::extension($request->importEmployee->getClientOriginalName());
            if ($extension == "csv") {
                $path = $request->importEmployee->getRealPath();
                $data = Excel::load($path, function($reader) {})->get();
                if(!empty($data) && $data->count()){
                    foreach($data as $record){
                        if(in_array($record->id_number,$employee_id)){
                            continue;   
                        }else if(Employee::where('id_number','=',$record->id_number)->exists()){
                            continue;
                        }else{
                            $employee_id[] = $record->id_number;
                            $record->date_of_birth = date('Y-m-d');
                            $insert_employee_data[] = [
                            
                                'f_name' => $record->first_name, 
                                'l_name' => $record->last_name,
                                'marital_status'=>$record->marital_status,
                                'dob' => $record->date_of_birth,
                                'id_number' => $record->id_number,
                                'gender'=> $record->gender,
                                'country'=>'-',
                                'blood_group'=>'-',
                                'religious'=>'-',
                                'terminate_status'=>0,
                                'created_at'=>Carbon::now(),
                                'updated_at'=>Carbon::now()
                            ];
                        }
                    }
                    if(!empty($insert_employee_data)){
                        $insert_employee = DB::table('employees')->insert($insert_employee_data);
                        Session::flash('success', 'Employees Data Imported!');
                    }else{
                        Session::flash('warning', 'Duplicated record, please check your csv file!');
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
        return redirect()->action('EmployeeController@index'); 
    }

    public function store(Request $request)
    {
        
    }

    public function terminate(Request $request){
        return response()->json($request);
    }

    public function terminateList(){
        $employees = Employee::where('terminate_status',true)->get();
        return view('admin.employees.terminate',['employees'=>$employees]);
    }

    public function show(Employee $employee)
    {   
        if(DB::table('user_attachments')->where('user_id',$employee->id)->exists()){
            $user_attachments = UserAttachment::where('user_id',$employee->id)->get();
        }else{
            $user_attachments = null;
        }
        return view('admin.employees.show',['employee'=>$employee,'attachments'=>$user_attachments]);
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
        return redirect()->action('ContactDetailController@show',['id'=>$contactDetailId]);
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
     * @param  \buzzeroffice\Employee  $employee
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
     * @param  \buzzeroffice\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        if ($request->hasFile('employee_photo')) {
            $image = $request->file('employee_photo');
            $name = $image->getClientOriginalName();
            $destinationPath = public_path('/employeesPhoto');
            $image->move($destinationPath, $name);
        }else{
            $name = NULL;
        }
        $update = Employee::where('id',$employee->id)->update([
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
        ]);
        return redirect()->route('employees.show',['id'=>$employee->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \buzzeroffice\Employee  $employee
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
        return redirect()->action(
            'EmployeeController@index'
        );
    }

    public function delete(Employee $employee){
        $delete = Employee::find($employee->id);
        $delete->delete();
        if($delete){
            Session::flash('success', 'Employee Data Deleted!');
        }else{
            Session::flash('failure', 'Something went wrong!');
        }
        return redirect()->action(
            'EmployeeController@index'
        );
    }
}
