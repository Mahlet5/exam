@extends('layouts.frontend')

@section('poststyles')
  <link href="{{ asset('css/summernote.css') }}" rel="stylesheet"></link>
@endsection

@section('content')
@include('admin.includes.errors')

<div class="panel panel-default col-md-6">
    <div class="panel-heading">Edit site settings</div>

    <div class="panel-body">
        <form class="" action="{{Route('settings.update')}}" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="site_name">Site name</label>
            <input class="form-control" type="text" name="site_name" value="{{ $settings->site_name }}">
          </div>
          <div class="form-group">
            <label for="logo">Logo</label>
            <input class="form-control" type="file" name="logo"><img src="{{ asset($settings->logo) }}" width="60" height="40" alt="">
          </div>
          <div class="form-group">
            <label for="address">Address</label>
            <input class="form-control" type="text" name="address" value="{{ $settings->address }}">
          </div>
          <div class="form-group">
            <label for="contact_number">Contact number</label>
            <input class="form-control" type="text" name="contact_number" value="{{ $settings->contact_number }}">
          </div>
          <div class="form-group">
            <label for="contact_email">Contact Email</label>
            <input class="form-control" type="email" name="contact_email" value="{{ $settings->contact_email }}">
          </div>
          <div class="form-group">
            <label for="about">About</label>
            <textarea class="form-control" id="about" name="about">{{ $settings->about }}</textarea>
          </div>
          <div class="form-group">
            <button class="btn btn-success" type="submit">
              Update setting
            </button>
          </div>
        </form>
    </div>
</div>
@endsection
@section('postscripts')
  <script type="text/javascript" src="{{ asset('js/summernote.min.js') }}"></script>
  <script>
    $(document).ready(function() {
        $('#about').summernote();
    });
  </script>

@endsection
