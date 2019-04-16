<?php

namespace buzzeroffice\Http\Controllers;

use buzzeroffice\PayGrade;
use Illuminate\Http\Request;

class PayGradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $paygrades = PayGrade::all();
        return view('admin.paygrades.index',['paygrades'=>$paygrades]);
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
        $store = PayGrade::create([
            'name'=>$request->grade_name,
            'minimum'=>(double)$request->min_salary,
            'maximum'=>(double)$request->max_salary
        ]);
        return redirect()->action('PayGradeController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \buzzeroffice\PayGrade  $payGrade
     * @return \Illuminate\Http\Response
     */
    public function show(PayGrade $payGrade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \buzzeroffice\PayGrade  $payGrade
     * @return \Illuminate\Http\Response
     */
    public function edit(PayGrade $paygrade)
    {
        //
        return response()->json($paygrade);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \buzzeroffice\PayGrade  $payGrade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PayGrade $paygrade)
    {
        //
        $update = PayGrade::where('id',$paygrade->id)->update([
            'name'=>$request->grade_name,
            'minimum'=>$request->min_salary,
            'maximum'=>$request->max_salary
        ]);
        return redirect()->action('PayGradeController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \buzzeroffice\PayGrade  $payGrade
     * @return \Illuminate\Http\Response
     */
    public function destroy(PayGrade $payGrade)
    {
        //
    }
    
    public function delete(PayGrade $paygrade){
        $delete = PayGrade::find($paygrade->id);
        $delete->delete();
        return redirect()->action('PayGradeController@index');
    }
}
