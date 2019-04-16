<?php

namespace buzzeroffice\Http\Controllers;

use buzzeroffice\EmergencyContact;
use Illuminate\Http\Request;

class EmergencyContactController extends Controller
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
        $store = EmergencyContact::create([
            'name'=>$request->name,
            'relationship'=>$request->relationship,
            'home_tel'=>$request->home_telephone,
            'mobile'=>$request->mobile,
            'work_tel'=>$request->work_telephone,
            'employee_id'=>$request->employee_id
        ]);
        return redirect()->action('UserController@contactDetails',['id'=>$request->employee_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \buzzeroffice\EmergencyContact  $emergencyContact
     * @return \Illuminate\Http\Response
     */
    public function show(EmergencyContact $emergencyContact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \buzzeroffice\EmergencyContact  $emergencyContact
     * @return \Illuminate\Http\Response
     */
    public function edit(EmergencyContact $emergencyContact)
    {
        return response()->json($emergencyContact);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \buzzeroffice\EmergencyContact  $emergencyContact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmergencyContact $emergencyContact)
    {
        $update = EmergencyContact::where('id',$emergencyContact->id)->update([
            'name'=>$request->name,
            'relationship'=>$request->relationship,
            'home_tel'=>$request->home_telephone,
            'mobile'=>$request->mobile,
            'work_tel'=>$request->work_telephone
        ]);
        return redirect()->action('UserController@contactDetails',['id'=>$emergencyContact->employee_id]);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \buzzeroffice\EmergencyContact  $emergencyContact
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmergencyContact $emergencyContact)
    {
        //
    }

    public function delete(Request $request){
        $emergencyContactId_array = $request->emergencyContact;
        if($emergencyContactId_array!=null){
            foreach($emergencyContactId_array as $id){
                $contact = EmergencyContact::find((int)$id);
                $contact->delete();
            }
            return redirect()->action('UserController@contactDetails',['id'=>$request->employee_id]);
        
        }else{
            return redirect()->action('UserController@contactDetails',['id'=>$request->employee_id]);
        }
    }
}
