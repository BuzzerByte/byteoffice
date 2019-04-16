<?php

namespace buzzeroffice\Http\Controllers;

use buzzeroffice\ContactDetail;
use buzzeroffice\EmergencyContact;
use buzzeroffice\Employee;
use buzzeroffice\User;
use Illuminate\Http\Request;

class ContactDetailController extends Controller
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

        return redirect()->action('UserController@contactDetails',['id'=>$request->employee_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \buzzeroffice\ContactDetail  $contactDetail
     * @return \Illuminate\Http\Response
     */
    public function show(ContactDetail $contactDetail)
    {
        $employee = User::where('id',$contactDetail->employee_id)->first();
        $emergencyContacts = EmergencyContact::where('employee_id',$contactDetail->employee_id)->get();
        
        return view('admin.contactDetails.show',['contactDetail'=>$contactDetail,'employee'=>$employee,'emergencyContacts'=>$emergencyContacts]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \buzzeroffice\ContactDetail  $contactDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(ContactDetail $contactDetail)
    {
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \buzzeroffice\ContactDetail  $contactDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContactDetail $contactDetail)
    {
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \buzzeroffice\ContactDetail  $contactDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactDetail $contactDetail)
    {
        //
    }
}
