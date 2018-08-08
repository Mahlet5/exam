<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CourseUser;
use App\User;
use App\Course;
use Session;
use Notification;

class CourseUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get teacher Assignments
        $assigned = CourseUser::all();
        //teachesr
        $teachers = User::where('role_id',3)->orderBy('name','ASC')->get();
        $courses = Course::all();
        return view('admin.assignments.index')->with(['assigned'=>$assigned,'teachers'=>$teachers,'courses'=>$courses]);
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
        $watchers = array();

        $this->validate($request, [
            'teacher'=>'required',
            'course'=>'required'
        ]);

        $user = User::find($request->teacher);

        $user->courses()->attach($request->course);

        //send email Notification
        array_push($watchers,$user);
        Notification::send($watchers, new \App\Notifications\CourseAssigned());

        Session::flash('success','Successfully assigned courses');
        return redirect()->route('course.assignments');
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
        $user = User::find($id);
        $user->courses()->detach();
        Session::flash('success','Successfully deleted assigned courses');
        return redirect()->route('course.assignments');
    }
}
