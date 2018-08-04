@extends('layouts.frontend')
@section('content')

@include('admin.includes.errors')

<div class="panel panel-default col-md-6">
    <div class="panel-heading">Edit your profile</div>

    <div class="panel-body">
        <form class="" action="{{ route('user.profile.update')}}" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="name">User</label>
            <input class="form-control" type="text" name="name" value="{{ $user->name }}">
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" value="{{ $user->email }}">
          </div>
          <div class="form-group">
            <label for="phone">Phone</label>
            <input class="form-control" type="phone" name="phone" value="{{ $user->profile->phone }}">
          </div>
          <div class="form-group">
            <label for="password">New Password</label>
            <input class="form-control" type="password" name="password">
          </div>
          <div class="form-group">
            <label for="avatar">Upload new avatar</label>
            <input class="form-control" type="file" name="avatar">
          </div>
          <div class="form-group">
            <button class="btn btn-success" type="submit">
              Update profile
            </button>
          </div>
        </form>
    </div>
</div>
@endsection
