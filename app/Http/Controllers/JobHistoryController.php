<?php

namespace App\Http\Controllers;

use App\JobHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class JobHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $request->effective_from = Carbon::parse($request->effective_from)->format('y-m-d');
        $store = JobHistory::create([
            'effective_from'=>$request->effective_from,
            'department_id'=>$request->department,
            'title_id'=>$request->title,
            'category_id'=>$request->category,
            'status_id'=>$request->employment_status,
            'shift_id'=>$request->work_shift,
            'employee_id'=>$request->employee_id
        ]);
        return redirect()->route('users.employeeCommencements',$request->employee_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\JobHistory  $jobHistory
     * @return \Illuminate\Http\Response
     */
    public function show(JobHistory $jobHistory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\JobHistory  $jobHistory
     * @return \Illuminate\Http\Response
     */
    public function edit(JobHistory $jobHistory)
    {
        return response()->json($jobHistory);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\JobHistory  $jobHistory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobHistory $jobHistory)
    {
        $update = JobHistory::where('id',$jobHistory->id)->update([
            'effective_from'=>$request->effective_from,
            'department_id'=>$request->department,
            'title_id'=>$request->title,
            'category_id'=>$request->category,
            'status_id'=>$request->employment_status,
            'shift_id'=>$request->work_shift
        ]); 
        return redirect()->route('users.employeeCommencements',$jobHistory->employee_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JobHistory  $jobHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobHistory $jobHistory)
    {
        //
    }

    public function delete(Request $request){
        // return response()->json($request);
        $jobId_arr = $request->jobId;
        if($jobId_arr!=null){
            foreach($jobId_arr as $id){
                $job = JobHistory::find((int)$id);
                $job->delete();
            }
            return redirect()->route('users.employeeCommencements',$request->employee_id);

        }else{
            return redirect()->route('users.employeeCommencements',$request->employee_id);
        }
    }
}
