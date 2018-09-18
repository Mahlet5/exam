<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Season;
use App\Material;
use Auth;
use Session;

class MaterialsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $course = Course::find($id);
        $seasons = Season::where('course_id',$id)->where('user_id',Auth::user()->id)->get();
        $materials = Material::all();
        return view('teacher.course.materials.index')->with(['seasons'=>$seasons,'course'=> $course, 'materials' => $materials]);
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
        $this->validate($request,[
            'mclass'=>'required',
            'description'=>'required',
            'document'=>'required'
        ]);

        //take care of the featured image first
        $featured = $request->document;
        //give a new name to this image
        //because the user can upload a new file with the same namespace
        $featured_new_name = time().$featured->getClientOriginalName();
        //move this file to our application
        //we will upload this file to a new directory we just created under
        //public, which is called uploads and under avatars
        $featured->move('uploads/materials',$featured_new_name);

        $material = new Material;
        $material->season_id = $request->mclass;
        $material->description = $request->description;
        $material->path = 'uploads/materials/' . $featured_new_name;

        $material->save();
        Session::flash('success','Material shared successfully.');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
