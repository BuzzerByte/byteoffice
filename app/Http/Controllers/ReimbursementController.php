<?php

namespace App\Http\Controllers;

use App\Reimbursement;
use App\Employee;
use App\Department;
use Excel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\JobHistory;

class ReimbursementController extends Controller
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
            $employees = User::all();
            $reimbursements = Reimbursement::all();
            return view('admin.reimbursements.index',['departments'=>$departments,'employees'=>$employees,'reimbursements'=>$reimbursements]);
        }else{
            $departments = Department::all();
            $employees = User::where('id',Auth::user()->id)->get();
            $reimbursements = Reimbursement::where('employee_id',Auth::user()->id)->get();
            return view('users.reimbursements.index',['departments'=>$departments,'employees'=>$employees,'reimbursements'=>$reimbursements]);
        }
        
    }

    public function approval(){
        $departments = Department::all();
        $employees = User::where('id',Auth::user()->id)->get();
        $reimbursements = Reimbursement::where('employee_id',Auth::user()->id)->where('m_approved',0)->where('a_approved',0)->get();
        return view('users.reimbursements.approval',['departments'=>$departments,'employees'=>$employees,'reimbursements'=>$reimbursements]);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if(Auth::user()->hasRole('admin')){
            $date = Carbon::parse($request->date)->format('Y-m-d');
            $store = Reimbursement::create([
                'date'=>$date,
                'description'=>$request->memo,
                'employee_id'=>(int)$request->employee_id,
                'department_id'=>(int)$request->department_id,
                'amount'=>doubleval($request->amount),
                'm_approved'=>0,
                'a_approved'=>0,
            ]);
        }else{
            $date = Carbon::parse($request->date)->format('Y-m-d');
            $jobHistory = JobHistory::CheckRecordExist(Auth::user()->id);
            if($jobHistory){
                $department_id = JobHistory::departmentId(Auth::user()->id);
            }else{
                $department_id = null;
            }
            $store = Reimbursement::create([
                'date'=>$date,
                'description'=>$request->memo,
                'employee_id'=>Auth::user()->id,
                'department_id'=>$department_id,
                'amount'=>doubleval($request->amount),
                'm_approved'=>0,
                'a_approved'=>0,
            ]);
        }
        
        return redirect()->action('ReimbursementController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reimbursement  $reimbursement
     * @return \Illuminate\Http\Response
     */
    public function show(Reimbursement $reimbursement)
    {
        //
        return response()->json($reimbursement);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reimbursement  $reimbursement
     * @return \Illuminate\Http\Response
     */
    public function edit(Reimbursement $reimbursement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reimbursement  $reimbursement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reimbursement $reimbursement)
    {
        //
        // return response()->json($request);
        $date = Carbon::parse($request->date)->format('Y-m-d');
        $update = Reimbursement::where('id',$reimbursement->id)->update([
            'department_id' => (int)$request->department_id,
            'employee_id' => (int)$request->employee_id,
            'date'=>$date,
            'amount'=>doubleval($request->amount),
            'description'=>$request->memo,
            // 'm_approved'=>$request->m_approved,
            'm_comment'=>$request->manager_comment,
            'a_approved'=>(int)$request->approved_admin,
            'a_comment'=>$request->admin_comment
        ]);
        return redirect()->action('ReimbursementController@index');
    }

    public function export(){
        Excel::create('Reimbursement List', function($excel) {   
            $excel->sheet('List', function($sheet) {      
                $data = array();
                $arr = Reimbursement::all();
                $temp = array();
                $sheet->row(1, array(
                    'Date','Department','Employee','Amount','Description','Manager Approved','Manager comment','Admin approved','Admin Comment','Created At','Updated At'
                ));
                foreach($arr as $index=>$row){
                    array_push($temp, $row['date']);
                    $department = Department::find($row['department_id']);
                    array_push($temp, $department->name);
                    $employee = Employee::find($row['employee_id']);
                    array_push($temp, $employee->f_name);
                    array_push($temp, $row['amount']);
                    array_push($temp, $row['description']);
                    array_push($temp, $row['m_approved']);
                    array_push($temp, $row['m_comment']);
                    array_push($temp, $row['a_approved']);
                    array_push($temp, $row['a_comment']);
                    array_push($temp, $row['created_at']);
                    array_push($temp, $row['updated_at']);
                    $sheet->appendRow($temp);
                    $temp = array();
                } 
            });
        })->export('csv');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reimbursement  $reimbursement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reimbursement $reimbursement)
    {
        //
        $delete = Reimbursement::find($reimbursement->id);
        $delete->delete();
        return response()->json($reimbursement);
    }

    public function delete(Reimbursement $reimbursement){
        $delete = Reimbursement::find($reimbursement->id);
        $delete->delete();
        return redirect()->action('ReimbursementController@index');
    }
}
