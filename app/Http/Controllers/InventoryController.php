<?php

namespace App\Http\Controllers;

use App\Inventory;
use App\Purchase;
use App\Supplier;
use App\Category;
use App\Tax;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Response;
use Excel;
use File;
use DB;
use App\Imports\InventoryImport;


class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $inventories = Inventory::all();
        $categories = Category::all();
        $taxes = Tax::all();
        if(empty($inventories)){
            return view('admin.inventory.index',['inventories'=>'No Inventory']);
        }else{
            return view('admin.inventory.index',['inventories'=>$inventories,'categories'=>$categories,'taxes'=>$taxes]);
        }
        
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function import()
    {
        $categories = Category::all();
        $taxes = Tax::all();
        return view('admin.inventory.import',['categories'=>$categories,'taxes'=>$taxes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'p_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $name = "";
        
        if ($request->hasFile('p_image')) {
            $image = $request->file('p_image');
            $name = $image->getClientOriginalName();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
        }else{
            $name = "image.png";
        }
        if($request->input('inventory')==null){
            $quantity = 0;
        }else{
            $quantity = $request->input('inventory');
        }
        $inventory = Inventory::create([
            'name' => $request->input('name'),
            'model_no' => $request->input('model_no'),
            'in_house'=>$request->input('in_house'),
            'image' => $name,
            's_price' => $request->input('sales_cost'),
            's_information' => $request->input('sales_info'),
            'p_price' => $request->input('buying_cost'),
            'p_information' => $request->input('buying_info'),
            'category_id' => (int)$request->input('category'),
            'tax_id' => (int)$request->input('tax'),
            'quantity' => $quantity,
            'type' => $request->input('type'),
            'user_id'=>Auth::user()->id
        ]);
        if($inventory){
            // Session::flash('success', 'Inventory Inserted Successfully!');
            flash()->success('Inventory Inserted Successfully!');
        }else{
            //Session::flash('failure', 'Something went wrong!');
            flash()->error('Something went wrong!');
        }
        $inventories = Inventory::all();
        return redirect()->route('inventory.index',['inventories'=>$inventories]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function show(Inventory $inventory)
    {   
        $data = Inventory::where('id',$inventory->id)->get();
        return response()->json(['inventory'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventory $inventory)
    {
        $data = Inventory::where('id',$inventory->id)->get();
        return response()->json(['inventory'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventory $inventory)
    {
        $this->validate($request, [
            'edited_p_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $name = "";
        if ($request->hasFile('edited_p_img')) {
            $image = $request->file('edited_p_img');
            $name = $image->getClientOriginalName();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
        }else{
            $org_img = Inventory::select('image')->where('id',$inventory->id)->get();
            $name = $org_img[0]['image'];
        }
        if($request->input('inventory')==null){
            $quantity = 0;
        }else{
            $quantity = $request->input('inventory');
        }
        $update = Inventory::where('id',$inventory->id)->update([
            'name' => $request->input('name'),
            'model_no' => $request->input('model_no'),
            'in_house'=>$request->input('in_house'),
            'image' => $name,
            's_price' => $request->input('sales_cost'),
            's_information' => $request->input('sales_info'),
            'p_price' => $request->input('buying_cost'),
            'p_information' => $request->input('buying_info'),
            'category_id' => (int)$request->input('category'),
            'tax_id' => (int)$request->input('tax'),
            'quantity' => $quantity,
            'type' => $request->input('type')
        ]);
        if($update){
            // Session::flash('success', 'Inventory Data Updated!');
            flash()->success('Inventory Data Updated!');
        }else{
            // Session::flash('failure', 'Something went wrong!');
            flash()->error('Something went wrong!');
        }
        $inventories = Inventory::all();
        return redirect()->route('inventory.index',['inventories'=>$inventories]);    
    }

    public function downloadInventorySample(){
        // Check if file exists in app/storage/file folder
        $file_path = storage_path() . "/app/downloads/inventory.csv";
        $headers = array(
            'Content-Type: csv',
            'Content-Disposition: attachment; filename=inventory.csv',
        );
        if (file_exists($file_path)) {
            flash()->success('File Downloaded!');
            return Response::download($file_path, 'inventory.csv', $headers);
        } else {
            flash()->error('Something went wrong!');
        }
        $inventories = Inventory::all();
        return redirect()->route('inventory.index',['inventories'=>$inventories]);
    }

    // import Inventory csv file
    public function importInventory(Request $request){
        $product_name = [];
        if ($request->hasFile('import_file')) {
            $extension = File::extension($request->import_file->getClientOriginalName());
            if ($extension == "csv") {
                $path = $request->import_file->getRealPath();
                // $data = Excel::load($path, function($reader) {})->get();
                $data = Excel::import(new InventoryImport, $request->import_file);
                if(!empty($data)){
                    foreach($data as $record){   
                        if(in_array($record->product_name,$product_name)){
                            continue;   
                        }else if(Inventory::where('name','=',$record->product_name)->exists()){
                            continue;
                        }else if($record->product_name == NULL || $record->product_name == "-"){
                            continue;
                        }else{
                            $inventory_name[] = $record->product_name;
                            $insert_inventory_data[] = [
                                'name' => $record->product_name, 
                                'model_no' => $record->model_no,
                                'in_house'=>$record->in_house,
                                's_price' => $record->sales_price,
                                's_information' => $record->sales_information,
                                'image'=>'image.png',
                                // 'open_balance' => $record->
                                'p_price' => $record->purchase_cost,
                                'p_information' => $record->purchase_information,
                                'quantity' => $record->product_quantity,
                                'type' => $record->product_type,
                                'category_id' => $record->category_id,
                                'tax_id' => $record->tax_id
                            ];
                        }
                    }
                    if(!empty($insert_inventory_data)){
                        $insert_inventory = DB::table('inventories')->insert($insert_inventory_data);
                        flash()->success('Inventories Data Imported!');
                    }else{
                        flash()->warning('Duplicated record, Please check your csv file!');
                    }
                }else{
                    flash()->warning('There is no data in csv file!');
                }
            }else{
                flash()->warning('Selected file is not csv!');
            }
        }else{
            flash()->error('Something went wrong');
        }
        $inventories = Inventory::all();
        return redirect()->route('inventory.index',['inventories'=>$inventories]);    
    }


    /**
     * Remove the specified resource from storage.
     *  
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventory $inventory)
    {
        Inventory::find($inventory->id)->delete();
        return response()->json(['success'=>'deleted successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Inventory  $Inventory
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $inventoryId_array = $request->inventory;
        if($inventoryId_array != null){
            foreach($inventoryId_array as $id){
                $inventory = Inventory::find((int)$id);
                $inventory->delete();
            }
            // Session::flash('success', 'Inventory Data Deleted!');
            flash()->success('Inventory Data Deleted');
            $inventories = Inventory::all();
            return redirect()->route('inventory.index',['inventories'=>$inventories]);   
        }else{
            $inventories = Inventory::all();
            // Session::flash('failure', 'Something went wrong!');
            flash()->error('Something went wrong!');
            return redirect()->route('inventory.index',['inventories'=>$inventories]);   
        }
    }
}
