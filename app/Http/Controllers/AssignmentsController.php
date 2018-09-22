<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Season;
use App\Assignment;
use Auth;
use Session;
use App\Http\Middleware\RedirectIfAuthenticated;

class AssignmentsController extends Controller
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
        $assignments = Assignment::all();
        return view('teacher.course.assignment.index')->with(['seasons'=>$seasons,'course'=> $course, 'assignments' => $assignments]);
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
        $featured->move('uploads/assignments',$featured_new_name);

        $assignment = new Assignment;
 
        $assignment->season_id = $request->mclass;
        $assignment->description = $request->description;
        $assignment->path = 'uploads/assignments/' . $featured_new_name;

        $assignment->save();
        Session::flash('success','Assignmnet shared successfully.');
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
    public function destroy($id,$course)
    {
        $assignment = Assignment::find($id);
        $assignment->delete();
        Session::flash('success','Successfully deleted class assignments.');
        return redirect()->back();

        
        $crs = Course::find($course);
        $assignments = Assignment::where('course_id',$course)->where('user_id',Auth::user()->id)->get();
        return view('teacher.course.assignmnet')->with(['assignmnets'=>$assignmnets,'course'=> $crs]);
    }
}
