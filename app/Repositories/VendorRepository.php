<?php

namespace App\Repositories;

use App\Vendor;
use Illuminate\Http\Request;
use Response;
use File;
use App\Imports\VendorsImport;
use Session;
use Excel;
use DB;

class VendorRepository
{
    /**
     * Get all of the vendor for the given user.
     *
     * @param  Vendor  $vendor
     * @return Collection
     */
    public function getAllVendors($user_id)
    {
        return Vendor::where('user_id', $user_id)
                    ->orderBy('created_at', 'asc')
                    ->get();
    }

    public function store($auth_id, Request $request){
        $vendor = new Vendor;
        $vendor->company = $request->company_name;
        $vendor->name = $request->name;
        $vendor->phone = $request->phone;
        $vendor->fax = $request->fax;
        $vendor->email = $request->email;
        $vendor->website = $request->website;
        $vendor->billing_address = $request->b_address;
        $vendor->note = $request->note;
        $vendor->user_id = $auth_id;
        return $vendor->save();
    }

    public function downloadVendorSample(){
        $file_path = storage_path() . "/app/downloads/vendor.csv";
        $headers = array(
            'Content-Type: csv',
            'Content-Disposition: attachment; filename=vendor.csv',
        );
        return ['result'=>file_exists($file_path),'file_path'=>$file_path,'headers'=>$headers];
    }

    public function import($auth_id, Request $request){
        $result = [];
        $vendor_name = [];
        if ($request->hasFile('import_file')) {
            $extension = File::extension($request->import_file->getClientOriginalName());
            if ($extension == "csv") {
                $path = $request->import_file->getRealPath();
                $data = Excel::import(new VendorsImport, $request->import_file);
                if(!empty($data)){
                    $result = ['result'=>true, 'status'=>'success','message'=>'Vendors Data Imported!'];
                }else{
                    $result = ['result'=>false, 'status'=>'warning','message'=>'There is no data in csv file!'];
                }
            }else{
                $result = ['result'=>false, 'status'=>'warning','message'=>'Selected file is not csv!'];
            }
        }else{
            $result = ['result'=>false, 'status'=>'warning','message'=>'Something went wrong!'];
        }
        return $result;
    }

    public function show(Vendor $vendor){
        return $vendor;
    }

    public function edit(Vendor $vendor){
        return $vendor;
    }

    public function update(Vendor $vendor, Request $request){
        $vendor = Vendor::find($vendor->id);
        $vendor->name = $request->name;
        $vendor->company = $request->company_name;
        $vendor->phone = $request->phone;
        $vendor->fax = $request->fax;
        $vendor->email = $request->email;
        $vendor->website = $request->website;
        $vendor->billing_address = $request->b_address;
        $vendor->note = $request->note;
        return $vendor->save();
    }

    public function destroy(Vendor $vendor){
        $vendor = Vendor::find($vendor->id);
        return $vendor->delete();
    }
}