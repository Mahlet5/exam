<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Season;
use App\Course;
use Auth;
use Session;

class SeasonsController extends Controller
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
        return view('admin.lookups.course.season')->with(['seasons'=>$seasons,'course'=> $course]);
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
        // dd($request->title);
        $this->validate($request,[
            'title'=>'required'
        ]);

        $class = new Season;
        $class->title = $request->title;
        $class->user_id = Auth::user()->id;
        $class->course_id = $request->course;
        $class->save();
        Session::flash('success','Successfully created class');

        $crs = Course::find($request->course);
        return redirect()->route('course.seasons',['id'=>$request->course,'course'=>$crs]);
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
        $season = Season::find($id);
        $season->delete();
        Session::flash('success','Successfully deleted class information.');
        $crs = Course::find($course);
        $seasons = Season::where('course_id',$course)->where('user_id',Auth::user()->id)->get();
        return view('admin.lookups.course.season')->with(['seasons'=>$seasons,'course'=> $crs]);
    }    
}
