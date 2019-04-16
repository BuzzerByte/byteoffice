<?php

namespace buzzeroffice\Http\Controllers;

use buzzeroffice\Category;
use buzzeroffice\Inventory;
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index',['categories'=>$categories]);  
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

    /**
     * Display the specified resource.
     *
     * @param  \buzzeroffice\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \buzzeroffice\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $data = Category::where('id',$category->id)->get();
        return response()->json(['category'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \buzzeroffice\Category  $category
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \buzzeroffice\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \buzzeroffice\Inventory  $Inventory
     * @return \Illuminate\Http\Response
     */
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
