<?php
use App\Role;
?>
@extends('layouts.frontend')
@section('poststyles')
@endsection
@section('content')
{{-- select a dashboard to render --}}
@if(Auth::user()->role_id==3)
    <div class="content">
      <div class="row">

      @foreach($courses as $course)
        <div class="col-md-3">
        <div class="box box-primary">
          <div class="box-header with-border" style="background-color:#697d9e;color:#fff;">
            <h3 class="box-title">{{ $course->title }}</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">

            <strong><i class="fa fa-book margin-r-5"></i>Manage</strong>

            <p>
              <span class="label label-warning">Students</span>
              <span class="label label-info">Materials</span>
              <span class="label label-success">Assignments</span>
            </p>

            <hr>

            <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>

            <p>{{ $course->description }}</p>
          </div>
          <!-- /.box-body -->
        </div>
          </div>
      @endforeach
      </div>
    </div>

    {{-- {{ $courses->links() }} --}}

@endif
@endsection
@section('postscripts')
@endsection
