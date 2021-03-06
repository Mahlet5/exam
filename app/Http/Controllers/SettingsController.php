<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use Session;
use Auth;


class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.settings.settings')->with('settings', Setting::first());
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
        // return redirect()->route('course.seasons',['id'=>$request->course]);
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
    public function update(Request $request)
    {
      $this->validate($request,[
        'site_name'=>'required',
        'contact_number'=>'required',
        'contact_email'=>'required|email',
        'address'=>'required',
        'about'=>'required',
      ]);

      $setting  = Setting::first();
      if($request->hasFile('logo')){
          $logo = $request->logo;
          $logo_new = time().$logo->getClientOriginalName();
          $logo->move('uploads/company',$logo_new);
          $setting->logo = 'uploads/company/'.$logo_new;
          $setting->save();
      }

      $setting->site_name = $request->site_name;
      $setting->contact_number = $request->contact_number;
      $setting->contact_email = $request->contact_email;
      $setting->address = $request->address;
      $setting->about = $request->about;

      $setting->save();
      Session::flash('success','Site settings updated successfully.');
      return redirect()->back();
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
