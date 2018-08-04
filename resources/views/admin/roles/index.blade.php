@extends('layouts.frontend')
@section('poststyles')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection
@section('content')
    <div class="col-md-6">
  <div class="box box-primary">
    <div class="box-header  with-border">
      <h3 class="box-title">User Roles</h3>
      {{-- <a href="{{ route('user.create') }}" style="float:right;" class="btn btn-xs btn-success">
                        Create</span>
      </a> --}}
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>Name</th>
          <th>Description</th>
        </tr>
        </thead>
        <tbody>
          @foreach ($roles as $role)
            <tr>
              <td>{{ $role->name }}</td>
              <td>{{ $role->description }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <!-- /.box-body -->
  </div>
</div>
  <div class="col-md-6">
  @include('admin.includes.errors')
  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Create Role</h3>
      {{-- <a href="{{ route('user.create') }}" style="float:right;" class="btn btn-xs btn-success">
                        Create</span>
      </a> --}}
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form class="form-horizontal" method="POST" action="{{ route('role.store') }}">
        {{ csrf_field() }}
        <div class="form-group">
          <label for="rolename" class="col-sm-2 control-label">Name</label>

          <div class="col-sm-10">
            <input type="text" class="form-control" id="rolename" name="rolename" placeholder="Role Name">
          </div>
        </div>
        <div class="form-group">
          <label for="description" class="col-sm-2 control-label">Description</label>

          <div class="col-sm-10">
            <textarea class="form-control" id="description" name="description" placeholder="Description"></textarea>
          </div>
        </div>
        <div class="box-footer">
          {{-- <button type="submit" class="btn btn-default">Cancel</button> --}}
          <button type="submit" class="btn btn-success pull-right">Save</button>
        </div>
      </form>
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
