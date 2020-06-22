<?php

namespace App\Http\Controllers;

use App\Category;
use App\Inventory;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Session;
use Response;
use Excel;
use File;
use DB;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index',['categories'=>$categories]);  
    }

    public function store(Request $request)
    {
        if (Category::where('name', '=', $request->name)->exists()) {
            // Session::flash('warning', 'This category already exists!');
            flash()->warning('This Category already exists!');
        }else{
            $category = Category::create([
                'name'=>$request->category
            ]);
            if($category){
                // Session::flash('success', 'New Category Added');
                flash()->success('New Category Added!');
            }else{
                // Session::flash('failure', 'Something went wrong!');
                flash()->error('Something went wrong!');
            }
        }
        $inventories = Inventory::all();
        $categories = Category::all();
        return redirect()->route('category.index',['categories'=>$categories]);     
    }

    public function edit(Category $category)
    {
        $data = Category::where('id',$category->id)->get();
        return response()->json(['category'=>$data]);
    }

    public function update(Request $request, Category $category)
    {
        $update = Category::where('id',$category->id)->update([
            'name' => $request->input('name'),
            
        ]);
        if($update){
            // Session::flash('success', 'Category Data Updated!');
            flash()->success('Category Data Updated!');
        }else{
            // Session::flash('failure', 'Something went wrong!');
            flash()->error('Something went wrong!');
        }
        $categories = Category::all();
        return redirect()->route('category.index',['categories'=>$categories]);  
    }
    
    public function delete(Category $category)
    {
        $data = Category::find($category->id);
        $data->delete();
        if($data){
            // Session::flash('success', 'Category Data Deleted!');
            flash()->success('Category Data deleted!');
        }else{
            // Session::flash('failure', 'Something went wrong!');
            flash()->error('Something went wrong!');
        }
        $categories = Category::all();
        return redirect()->route('category.index',['categories'=>$categories]);    
    }
}
