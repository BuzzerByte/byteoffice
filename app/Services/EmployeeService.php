<?php

namespace App\Services;

use App\Repositories\Interfaces\IRoleRepository;
use App\Repositories\Interfaces\IEmployeeRepository;
use App\Repositories\Interfaces\IRoleEmployeeRepository;
use App\Repositories\Interfaces\IEmployeeAttachmentRepository;
use Illuminate\Http\Request;
use File;
use App\Imports\EmployeeImport;
use App\Exports\EmployeeExport;
use Excel;

class EmployeeService{
    protected $roles;
    protected $employees;
    protected $roleEmployees;
    protected $employeeAttachments;

    public function __construct(
        IRoleRepository $roles,
        IEmployeeRepository $employees,
        IRoleEmployeeRepository $roleEmployees,
        IEmployeeAttachmentRepository $employeeAttachments
    ){
        $this->roles = $roles;
        $this->employees = $employees;
        $this->roleEmployees = $roleEmployees;
        $this->employeeAttachments = $employeeAttachments;
    }

    public function getRoles(){
        return $this->roles->all();
    }

    public function all(){
        return $this->employees->all();
    }

    public function avatar(Request $request){
        if ($request->hasFile('employee_photo')) {
            $image = $request->file('employee_photo');
            $file_name = $image->getClientOriginalName();
            $destinationPath = public_path('/employeesPhoto');
            $image->move($destinationPath, $name);
        }else{
            $file_name = NULL;
        }
        return $file_name;
    }

    public function store(Request $request, $file_name){
        return $this->employees->store($request, $file_name);
    }

    public function downloadSample(){
        $file_path = storage_path() . "/app/downloads/employee.csv";
        $headers = array(
            'Content-Type: csv',
            'Content-Disposition: attachment; filename=employee.csv',
        );
        return [
            'file_exists' => file_exists($file_path),
            'file_path'=> $file_path,
            'headers'=>$headers
        ];
    }

    public function import(Request $request){
        $result = [];
        if ($request->hasFile('importEmployee')) {
            $extension = File::extension($request->importEmployee->getClientOriginalName());
            if ($extension == "csv") {
                $path = $request->importEmployee->getRealPath();
                $data = Excel::import(new EmployeeImport, $request->importEmployee);
                if(!empty($data)){
                    $result = ['result'=>true, 'status'=>'success','message'=>'Employees Data Imported!'];
                }else{
                    $result = ['result'=>false, 'status'=>'warning','message'=>'There is no data in csv file!'];
                }
            }else{
                $result = ['result'=>false, 'status'=>'warning','message'=>'Selected file is not csv!'];
            }
        }else{
            $result = ['result'=>false, 'status'=>'warning','message'=>'Something went wrong!'];
        }
        return $result;
    }

    public function role(Request $request, $employee){
        $role_employee = $this->roleEmployees->store($request, $employee);
        return [
            'result'=>$role_employee['result'],
            'role_employee'=>$role_employee['role_employee']
        ];
    }

    public function getTerminate(){
        return $this->employees->getTerminate();
    }

    public function checkAttachmentsExists(Employee $employee){
        return $this->employeeAttachments->checkAttachmentsExists($employee);
    }
}