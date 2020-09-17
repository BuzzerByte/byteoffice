<?php

namespace App\Services;

use App\Repositories\Interfaces\IRoleRepository;
use App\Repositories\Interfaces\IEmployeeRepository;
use Illuminate\Http\Request;
use File;
use App\Imports\EmployeeImport;
use App\Exports\EmployeeExport;

class EmployeeService{
    protected $roles;
    protected $employees;

    public function __construct(
        IRoleRepository $roles,
        IEmployeeRepository $employees
    ){
        $this->roles = $roles;
        $this->employees = $employees;
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
                    if(!empty($insert_employee_data))
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
}