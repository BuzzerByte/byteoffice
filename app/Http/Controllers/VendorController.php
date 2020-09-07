<?php

namespace App\Http\Controllers;

use App\Vendor;
use Illuminate\Http\Request;
use Session;
use Response;
use Excel;
use File;
use DB;
use App\Imports\VendorsImport;
use Auth;
use App\Services\VendorService;
use App\Services\UserService;

class VendorController extends Controller
{

    protected $vendors;
    protected $auth_user;

    public function __construct(UserService $auth_user, VendorService $vendors)
    {
        $this->vendors = $vendors;
        $this->auth_user = $auth_user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auth_id = $this->auth_user->getAuthId();
        $vendors =  $this->vendors->all($auth_id);
        if(empty($vendors)){
            return view('admin.vendors.index',['vendors'=>'No Vendor']);
        }else{
            return view('admin.vendors.index',['vendors'=>$vendors]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $auth_id = $this->auth_user->getAuthId();
        $result = $this->vendors->store($auth_id, $request);
        $result == true ? flash()->success('Vendor Inserted Successfully'):flash()->error('Something went wrong!');
        return redirect()->route('vendor.index');
    }

    public function downloadVendorSample(){
        $result = $this->vendors->downloadVendorSample();
        if($result['result']){
            flash()->success('Sample downloaded');
            return Response::download($result['file_path'], 'vendor.csv', $result['headers']);
        }else{
            flash()->error('Something went wrong!');
        }
        return redirect()->route('vendor.index');
    }

    public function import(Request $request){
        $this->validate($request, array(
            'import_file'      => 'required'
        ));
        $auth_id = $this->auth_user->getAuthId();
        $result = $this->vendors->import($auth_id, $request);
        if($result['result'] && $result['status']=='success'){
            flash()->success($result['message']);
        }else if($result['result'] && $result['status']=='warning'){
            flash()->warning($result['message']);
        }else{
            flash()->error($result['message']);
        }
        return redirect()->route('vendor.index');    
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function show(Vendor $vendor)
    {
        return $this->vendors->show($vendor);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendor $vendor)
    {
        return $this->vendors->edit($vendor);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vendor $vendor)
    {
        $result = $this->vendors->update($request, $vendor);
        $result == true ? flash()->success('Vendor Updated Successfully'):flash()->error('Something went wrong!');
        return redirect()->route('vendor.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendor $vendor)
    {
        $result = $this->vendors->destroy($vendor);
        $result == true ? flash()->success('Vendor Deleted Successfully'):flash()->error('Something went wrong!');
        return redirect()->route('vendor.index');
    }
}
