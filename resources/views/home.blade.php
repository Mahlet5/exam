<?php
use App\Role;
?>
@extends('layouts.frontend')
@section('poststyles')
@endsection
@section('content')
{{-- select a dashboard to render --}}
@if(Auth::user()->role_id==1)
  @include('dashboards.admin');
@elseif(Auth::user()->role_id==2)
  @include('dashboards.student',['seasons'=>$seasons]);
@elseif(Auth::user()->role_id==3)
  @include('dashboards.teacher',['courses'=>$courses]);
@endif

@endsection
@section('postscripts')
@endsection
