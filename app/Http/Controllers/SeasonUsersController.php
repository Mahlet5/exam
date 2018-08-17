<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Season;
use App\Course;
use App\SeasonUser;
use App\User;
use Auth;
use Session;
use Notification;

class SeasonUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id,$course)
    {
        $season = Season::find($id);
        //this is the course id
        $crs = Course::find($course);
        $students = SeasonUser::where('season_id',$id)->get();


        //select the ones that are not already assigned to the class
        $studs = User::where('role_id',2)->get();

        return view('teacher.course.students.index')->with(['season'=>$season,'course'=>$crs,'students'=>$students, 'studs'=>$studs]);
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
        $watchers = array();
        $season = Season::find($request->season);
        
        $season->users()->attach($request->students);

        $students = User::whereIn('id',$request->students)->get();

        //send email Notification to included students
        Notification::send($students, new \App\Notifications\IncludedInClass($season));

        Session::flash('success','Successfully added students to class.');
        return redirect()->route('class.students',['id'=>$season->id,'course'=>$season->course_id]);
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
    public function destroy($season,$student)
    {

        $entry = SeasonUser::where('season_id',$season)->where('user_id',$student)->first();
        $entry->delete();
        Session::flash('success','Successfully removed student from class');

        $ssn = Season::find($season);

        return redirect()->route('class.students',['id'=>$season,'course'=>$ssn->course_id]);
    }
}
