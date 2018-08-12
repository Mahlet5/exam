@extends('layouts.frontend')
@section('poststyles')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection
@section('content')
    <div class="col-md-6">
  <div class="box box-primary">
    <div class="box-header  with-border">
      <h3 class="box-title">{{ $course->title }} Classes</h3>
      {{-- <a href="{{ route('user.create') }}" style="float:right;" class="btn btn-xs btn-success">
                        Create</span>
      </a> --}}
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>Class</th>
          <th>Course</th>
          <th>Students</th>
          <th>Delete</th>
        </tr>
        </thead>
        <tbody>
          @foreach ($seasons as $season)
            <tr>
              <td>{{ $season->title }}</td>
              <td>{{ $season->course->title }}</td>
              <td>
                <a href="{{ route('class.students',['id'=>$season->id,'course'=>$course->id]) }}" class="btn btn-xs btn-info">
                                  students</span>
                </a>
              </td>
              <td>
                <a href="{{ route('course.delete',['id'=>$season->id,'course'=>$course->id]) }}" class="btn btn-xs btn-danger">
                                  <span class="glyphicon glyphicon-trash"></span>
                </a>
              </td>
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
      <h3 class="box-title">Create Class</h3>
      {{-- <a href="{{ route('user.create') }}" style="float:right;" class="btn btn-xs btn-success">
                        Create</span>
      </a> --}}
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form class="form-horizontal" method="POST" action="{{ route('class.store') }}">
        {{ csrf_field() }}
        <div class="form-group">
          <label for="title" class="col-sm-2 control-label">Title</label>

          <div class="col-sm-10">
            <input type="text" class="form-control" id="title" name="title" placeholder="Class Name">
            <input type="hidden" class="form-control" id="course" name="course" value="{{ $course->id }}"/>
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
