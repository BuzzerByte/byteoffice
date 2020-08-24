<?php

namespace App\Http\Controllers;

use App\ContactDetail;
use App\EmergencyContact;
use App\Employee;
use App\User;
use Illuminate\Http\Request;

class ContactDetailController extends Controller
{
    public function store(Request $request)
    {
        $store = ContactDetail::updateOrCreate([
            'employee_id'=>$request->employee_id],[
            'street1'=>$request->address_1,
            'street2'=>$request->address_2,
            'city'=>$request->city,
            'state'=>$request->state,
            'zip'=>$request->postal,
            'country'=>$request->country,
            'home_tel'=>$request->home_telephone,
            'work_email'=>$request->work_email,
            'work_tel'=>$request->work_telephone,
            'other_email'=>$request->other_email,
            'mobile'=>$request->mobile
        ]);

        return redirect()->route('employees.contactDetails',$request->employee_id);
    }

    public function show(ContactDetail $contactDetail)
    {
        $employee = Employee::where('id',$contactDetail->employee_id)->first();
        $emergencyContacts = EmergencyContact::where('employee_id',$contactDetail->employee_id)->get();
        
        return view('admin.contactDetails.show',['contactDetail'=>$contactDetail,'employee'=>$employee,'emergencyContacts'=>$emergencyContacts]);
    }
}
