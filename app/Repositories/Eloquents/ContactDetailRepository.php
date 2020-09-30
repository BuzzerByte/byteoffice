<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\IContactDetailRepository;
use App\ContactDetail;

class ContactDetailRepository implements IContactDetailRepository{
    protected $contactDetails;

    public function __construct(
        ContactDetail $contactDetails
    ){
        $this->contactDetails = $contactDetails;
    }

    public function checkContactDetailExists($id){
        return $this->contactDetails->where('employee_id',$id)->first() == null ? false:true;
    }

    public function getContactDetailById($id){
        return [
            'contactDetail'=>$this->contactDetails->where('employee_id',$id)->first()
        ];
    }

    public function storeContactDetailById($id){
        $contactDetail = $this->contactDetails;
        $contactDetail->employee_id = $id;
        return [
            'result' => $contactDetail->save(),
            'contactDetail' => $contactDetail
        ];
    }
}