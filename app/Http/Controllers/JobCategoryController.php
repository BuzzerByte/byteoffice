<?php

namespace buzzeroffice\Http\Controllers;

use buzzeroffice\JobCategory;
use Illuminate\Http\Request;

class JobCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $jobcategories = JobCategory::all();
        return view('admin.jobCategories.index',['jobcategories'=>$jobcategories]);
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
        //
        $store = JobCategory::create([
            'category'=>$request->category
        ]);
        return redirect()->action('JobCategoryController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \buzzeroffice\JobCategory  $jobCategory
     * @return \Illuminate\Http\Response
     */
    public function show(JobCategory $jobCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \buzzeroffice\JobCategory  $jobCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(JobCategory $jobCategory)
    {
        //
        return response()->json($jobCategory);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \buzzeroffice\JobCategory  $jobCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobCategory $jobCategory)
    {
        $update = JobCategory::where('id',$jobCategory->id)->update([
            'category'=>$request->category
        ]);
        return redirect()->action('JobCategoryController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \buzzeroffice\JobCategory  $jobCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobCategory $jobCategory)
    {
        //
    }

    public function delete(JobCategory $jobCategory){
        $delete = JobCategory::find($jobCategory->id);
        $delete->delete();
        return redirect()->action('JobCategoryController@index');
    }
}
