<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\IEmployeeAwardRepository;
use Illuminate\Http\Request;
use App\EmployeeAward;

class EmployeeAwardRepository implements IEmployeeAwardRepository{
    protected $employeeAwards;

    public function __construct(EmployeeAward $employeeAwards){
        $this->employeeAwards = $employeeAwards;
    }

    public function all(){
        return $this->employeeAwards->leftjoin('employees','employee_awards.employee_id','employees.id')
                    ->leftjoin('users','employees.user_id','users.id')
                    ->orderBy('employee_awards.created_at','asc')
                    ->get();
    }

    public function store(Request $request){
        $employeeAward = $this->employeeAwards;
        $employeeAward->department_id = (int)$request->department_id;
        $employeeAward->employee_id = (int)$request->employee_id;
        $employeeAward->award = (int)$request->award_name;
        $employeeAward->gift = (int)$request->gift_item;
        $employeeAward->amount = (int)$request->award_amount;
        $employeeAward->month = (int)$request->month;
        return [
            'result' => $employeeAward->save(),
            'employeeAward' => $employeeAward
        ];
    }

    public function update(Request $request, $id){
        $employeeAward = $this->employeeAwards->find($id);
        $employeeAward->department_id = (int)$request->department_id;
        $employeeAward->employee_id = (int)$request->employee_id;
        $employeeAward->award = (int)$request->award_name;
        $employeeAward->gift = (int)$request->gift_item;
        $employeeAward->amount = (int)$request->award_amount;
        $employeeAward->month = (int)$request->month;
        return [
            'result' => $employeeAward->save(),
            'employeeAward' => $employeeAward
        ];
    }

    public function destroy($id){
        $employeeAward = $this->employeeAward->find($id);
        return [
            'result' => $employeeAward->delete()
        ];
    }
}