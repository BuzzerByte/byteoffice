<?php

namespace buzzeroffice\Http\Controllers;

use buzzeroffice\SalaryComponent;
use Illuminate\Http\Request;

class SalaryComponentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $salaries = SalaryComponent::all();
        return view('admin.salarycomponents.index',['salaries'=>$salaries]);
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
        $store = SalaryComponent::create([
            'component_name' => $request->component_name,
            'type' => (int)$request->type,
            'total_payable' => $request->total_payable,
            'cost_company'=>$request->cost_company,
            'value_type'=>(int)$request->value_type
        ]);
        return redirect()->action('SalaryComponentController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \buzzeroffice\SalaryComponent  $salaryComponent
     * @return \Illuminate\Http\Response
     */
    public function show(SalaryComponent $salaryComponent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \buzzeroffice\SalaryComponent  $salaryComponent
     * @return \Illuminate\Http\Response
     */
    public function edit(SalaryComponent $salarycomponent)
    {
        //
        return response()->json($salarycomponent);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \buzzeroffice\SalaryComponent  $salaryComponent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SalaryComponent $salarycomponent)
    {
        //
        $update = SalaryComponent::where('id',$salarycomponent->id)->update([
            'component_name' => $request->component_name,
            'type' => (int)$request->type,
            'total_payable' => $request->total_payable,
            'cost_company' => $request->cost_company,
            'value_type' => (int)$request->value_type
        ]);
        return redirect()->action('SalaryComponentController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \buzzeroffice\SalaryComponent  $salaryComponent
     * @return \Illuminate\Http\Response
     */
    public function destroy(SalaryComponent $salaryComponent)
    {
        //
    }

    public function delete(SalaryComponent $salarycomponent){
        $delete = SalaryComponent::find($salarycomponent->id);
        $delete->delete();
        return redirect()->action('SalaryComponentController@index');
    }
}
