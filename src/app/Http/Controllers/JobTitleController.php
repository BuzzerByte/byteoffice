<?php

namespace App\Http\Controllers;

use App\JobTitle;
use Illuminate\Http\Request;

class JobTitleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobtitles = JobTitle::all();
        return view('admin.jobtitles.index',['jobtitles'=>$jobtitles]);
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
        $store = JobTitle::create([
            'title'=>$request->title,
            'description'=>$request->description
        ]);
        return redirect()->action('JobTitleController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\JobTitle  $jobTitle
     * @return \Illuminate\Http\Response
     */
    public function show(JobTitle $jobTitle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\JobTitle  $jobTitle
     * @return \Illuminate\Http\Response
     */
    public function edit(JobTitle $jobtitle)
    {
        return response()->json($jobtitle);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\JobTitle  $jobTitle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobTitle $jobtitle)
    {
        $update = JobTitle::where('id',$jobtitle->id)->update([
            'title'=>$request->department,
            'description'=>$request->description
        ]);
        return redirect()->action('JobTitleController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JobTitle  $jobTitle
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobTitle $jobTitle)
    {
        //
    }

    public function delete(JobTitle $jobtitle){
        $delete = JobTitle::find($jobtitle->id);
        $delete->delete();
        return redirect()->action('JobTitleController@index');
    }
}
