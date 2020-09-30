<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\IReimbursementRepository;
use App\Reimbursement;
use Illuminate\Http\Request;

class ReimbursementRepository implements IReimbursementRepository{
    protected $reimbursements;

    public function __contruct(Reimbursement $reimbursements){
        $this->reimbursements = $reimbursements;
    }

    public function all(){
        $reimbursements = Reimbursement::all();
        if($reimbursements->isEmpty()) return [];
        return $this->reimbursements->leftjoin('employees','reimbursements.employee_id','employees.id')
                                    ->leftjoin('users','users.id','employees.user_id')
                                    ->orderBy('reimbursements.created_at','asc')
                                    ->get();
    }

    public function store(Request $request){
        $reimbursement = $this->reimbursements;
        $reimbursement->date = Carbon::parse($request->date)->format('Y-m-d');
        $reimbursement->description = $request->memo;
        $reimbursement->employee_id = (int)$request->employee_id;
        $reimbursement->department_id = (int)$request->department_id;
        $reimbursement->amount = doubleval($request->amount);
        $reimbursement->m_approved = 0;
        $reimbursement->a_approved = 0;
       
        return [
            'result' => $reimbursement->save(),
            'reimbursement' => $reimbursement
        ];
    }

    public function update(Request $request, $id){
        $reimbursement = $this->reimbursements->find($id);
        $reimbursement->date = Carbon::parse($request->date)->format('Y-m-d');
        $reimbursement->description = $request->memo;
        $reimbursement->employee_id = (int)$request->employee_id;
        $reimbursement->department_id = (int)$request->department_id;
        $reimbursement->amount = doubleval($request->amount);
        $reimbursement->m_approved = 0;
        $reimbursement->m_comment  = $request->manager_comment;
        $reimbursement->a_approved = 0;
        $reimbursement->a_comment  = $request->admin_comment;
        return [
            'result' => $reimbursement->save(),
            'reimbursement' => $reimbursement
        ];
    }

    public function destroy($id){
        $reimbursement = $this->reimbursements->find($id);
        return [
            'result' => $reimbursement->delete()
        ];
    }
}