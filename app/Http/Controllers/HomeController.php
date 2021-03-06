<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\CourseUser;
use App\SeasonUser;
use App\Season;
use App\Role;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role_id == 3){
          //return user courses
          $courses = Course::whereHas('users',function($q){
            $q->where('user_id',Auth::user()->id);
          })->get();

          return view('home')->with(['courses'=> $courses]);
        }
        elseif(Auth::user()->role_id == 2){
             //return user seasons
          $seasons = Season::whereHas('users',function($q){
            $q->where('user_id',Auth::user()->id);
          })->get();

          return view('home')->with(['seasons'=>$seasons,]);
        }
        return view('home');
    }
}
