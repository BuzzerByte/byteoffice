<?php

namespace App\Http\Controllers;

use App\EmergencyContact;
use Illuminate\Http\Request;

class EmergencyContactController extends Controller
{
    
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

    public function edit(EmergencyContact $emergencyContact)
    {
        return response()->json($emergencyContact);
    }

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
