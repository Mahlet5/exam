@extends('layouts.frontend')
@section('poststyles')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection
@section('content')
<div class="col-md-12">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Users</h3>
      {{-- <a href="{{ route('user.create') }}" style="float:right;" class="btn btn-xs btn-success">
                        Create</span>
      </a> --}}
      <a href="{{ route('user.create') }}" style="float:right;" class="btn btn-success ml-1" data-toggle="tooltip" title="Create New">
        <i class="fa fa-plus-circle"></i></a>

    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>Image</th>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Role</th>
          <th>Delete</th>
        </tr>
        </thead>
        <tbody>
          @foreach ($users as $user)
            <tr>
              <td><img src="{{ asset($user->profile->avatar) }}" width="50" height="40"></td>
              <td>{{ $user->name }}</td>
              <td>{{ $user->email }}</td>
              <td>{{ $user->profile->phone }}</td>
              <td>
                  @foreach ($roles as $role)
                    @if($user->role_id == $role->id)
                      {{ $role->name }}
                    @endif
                  @endforeach
              </td>
              <td>
                {{-- check if its not the logged in user --}}
                @if(Auth::user()->id != $user->id)
                  <a href="{{ route('user.delete',['id'=>$user->id]) }}" class="btn btn-xs btn-danger">
                                    <span class="glyphicon glyphicon-trash"></span>
                  </a>
                @endif
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <!-- /.box-body -->
  </div>
</div>
@endsection
@section('postscripts')
  <!-- DataTables -->
  <script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
  <script>
    $(function () {
      // $('#example1').DataTable()
      $('#example1').DataTable({
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false
      })
    })
  </script>
@endsection
