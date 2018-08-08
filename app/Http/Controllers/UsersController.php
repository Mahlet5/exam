<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Profile;
use Session;
use Notification;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index')->with(['users'=>User::all(),'roles'=>Role::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create')->with(['roles'=>Role::all()]);
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

      $this->validate($request,[
        'fullname'=>'required',
        'email'=>'required|email',
        'phone'=>'required',
        'featured'=>'required|image',
      ]);

      $user = new User;
      $user->name = $request->fullname;
      $user->email = $request->email;
      $user->role_id = $request->role;
      $user->password = bcrypt('password');

      $user->save();

      //insert the profile
      $profile = new Profile;
      //take care of the featured image first
      $featured = $request->featured;
      //give a new name to this image
      //because the user can upload a new file with the same namespace
      $featured_new_name = time().$featured->getClientOriginalName();
      //move this file to our application
      //we will upload this file to a new directory we just created under
      //public, which is called uploads and under avatars
      $featured->move('uploads/avatars',$featured_new_name);
      $profile->avatar = 'uploads/avatars/' . $featured_new_name;
      $profile->user_id = $user->id;
      $profile->phone = $request->phone;

      $profile->save();
      //send email Notification
      // array_push($watchers,$user);
      // Notification::send($watchers, new \App\Notifications\NewUserAdded());

      Session::flash('success','User created successfully');
      //send confirmation emails
      // \Mail::to($user)->send(new welcome);


      return redirect()->route('users');
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
      $user->profile->delete();
      $user->delete();

      Session::flash('success','User deleted successfully');
      return redirect()->route('users');
    }
}
