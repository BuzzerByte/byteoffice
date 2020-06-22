<?php

namespace App\Http\Controllers;

use App\Vendor;
use Illuminate\Http\Request;
use Session;
use Response;
use Excel;
use File;
use DB;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendors = Vendor::all();
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
        $vendor = Vendor::create([
            'name' => $request->input('name'),
            'company' => $request->input('company_name'),
            'phone' => $request->input('phone'),
            // 'open_balance'
            'fax' => $request->input('fax'),
            'email' => $request->input('email'),
            'website' => $request->input('website'),
            'billing_address' => $request->input('b_address'),
            'note' => $request->input('note')
        ]);
        if($vendor){
            flash()->success('Client Inserted Successfully!');  
        }else{
            flash()->error('Something went wrong!');
        }
        $vendors = Vendor::all();
        return redirect()->route('vendor.index',['vendors'=>$vendors]);
    }

    public function downloadVendorSample(){
        // Check if file exists in app/storage/file folder
        $file_path = storage_path() . "/app/downloads/vendor.csv";
        $headers = array(
            'Content-Type: csv',
            'Content-Disposition: attachment; filename=vendor.csv',
        );
        if (file_exists($file_path)) {
            // Send Download
            flash()->success('File Downloaded');
            return Response::download($file_path, 'vendor.csv', $headers);
        } else {
            // Error
            flash()->error('Something went wrong!');
        }
        $vendors = Vendor::all();
        return redirect()->route('vendor.index',['vendors'=>$vendors]);
    }

    public function import(Request $request){
        $this->validate($request, array(
            'import_file'      => 'required'
        ));
        $vendor_name = [];
        if ($request->hasFile('import_file')) {
            $extension = File::extension($request->import_file->getClientOriginalName());
            if ($extension == "csv") {
                $path = $request->import_file->getRealPath();
                $data = Excel::load($path, function($reader) {})->get();
                if(!empty($data) && $data->count()){
                    foreach($data as $record){
                        if(in_array($record->vendor_name,$vendor_name)){
                            continue;   
                        }else if(Vendor::where('name','=',$record->vendor_name)->exists()){
                            continue;
                        }else if($record->vendor_name == NULL || $record->vendor_name == "-"){
                            continue;
                        }else{
                            $vendor_name[] = $record->vendor_name;
                            $insert_vendor_data[] = [
                                'name' => $record->vendor_name, 
                                'company' => $record->company,
                                'phone' => $record->phone,
                                // 'open_balance' => $record->
                                'fax' => $record->fax,
                                'email' => $record->email,
                                'website' => $record->website,
                                'billing_address' => $record->billing_address,
                                'note' => $record->note
                            ];
                        }
                    }
                    if(!empty($insert_vendor_data)){
                        $insert_vendor = DB::table('vendors')->insert($insert_vendor_data);
                        flash()->success('Vendors Data Imported!');
                    }else{
                        flash()->warning('Duplicated record, please check your csv file!');
                    }
                }else{
                    flash()->warning('There is no data in csv file!');
                }
            }else{
                flash()->warning('Selected file is not csv!');
            }
        }else{
            flash()->error('Something went wrong!');
        }
        $vendors = Vendor::all();
        return redirect()->route('vendor.index',['vendors'=>$vendors]);    
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function show(Vendor $vendor)
    {
        $data = Vendor::where('id',$vendor->id)->get();
        return response()->json(['vendor'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendor $vendor)
    {
        $data = Vendor::where('id',$vendor->id)->get();
        return response()->json(['vendor'=>$data]);
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
        $update = Vendor::where('id',$vendor->id)->update([
            'name'=>$request->name,
            'company'=>$request->company_name,
            'phone'=>$request->phone,
            'fax'=>$request->fax,
            'email'=>$request->email,
            'website'=>$request->website,
            'billing_address'=>$request->b_address,
            'note'=>$request->note
        ]);
        if($update){
            flash()->success('Vendor Data Updated!');
        }else{
            flash()->error('Something went wrong!');
        }
        $vendors = Vendor::all();
        return redirect()->route('vendor.index',['vendors'=>$vendors]);    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendor $vendor)
    {
        //
    }

   
    public function delete(Vendor $vendor)
    {
        $data = Vendor::find($vendor->id);
        $data->delete();
        if($data){
            flash()->success('Vendor Data Deleted!');
        }else{
            flash()->error('Something went wrong!');    
        }
        $vendors = Vendor::all();
        return redirect()->route('vendor.index',['vendors'=>$vendors]);    

    }
}
