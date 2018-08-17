@extends('layouts.frontend')
@section('poststyles')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('bower_components/select2/dist/css/select2.min.css') }}">
@endsection
@section('content')
  <div class="col-md-6">
  <div class="box box-primary">
    <div class="box-header  with-border">
      <div class="alert alert-success" role="alert">
        Class of <b>{{ $season->title }}</b> on {{ $course->title }} | Student sheet.
      </div>
      {{-- <a href="{{ route('user.create') }}" style="float:right;" class="btn btn-xs btn-success">
                        Create</span>
      </a> --}}
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>Student</th>
          <th>Delete</th>
        </tr>
        </thead>
        <tbody>
          @foreach ($season->users as $student)
            <tr>
              <td>{{ $student->name }}</td>
              <td>
                <a href="{{ route('class.assignment.delete',['season'=>$season->id,'student'=>$student->id]) }}" class="btn btn-xs btn-danger">
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
      <h3 class="box-title">Assign Students</h3>
      {{-- <a href="{{ route('user.create') }}" style="float:right;" class="btn btn-xs btn-success">
                        Create</span>
      </a> --}}
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form class="form-horizontal" method="POST" action="{{ route('student.assign') }}">
        {{ csrf_field() }}
          <div class="form-group">
            <label for="season" class="col-sm-2 control-label">Class</label>

            <div class="col-sm-10">
              <select class="form-control" id="season" name="season">
                <option value="{{ $season->id }}">{{ $season->title }}</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="course" class="col-sm-2 control-label">Course</label>

            <div class="col-sm-10">
              <select class="form-control" id="course" name="course">
                <option value="{{ $course->id }}">{{ $course->title }}</option>
              </select>
            </div>
          </div>
          <div class="form-group">
          <label for="students" class="col-sm-2 control-label">Students</label>
          <div class="col-sm-10">
            <select class="form-control select2" multiple="multiple" id="students[]" name="students[]" data-placeholder="Select courses"
                    style="width: 100%;">
                    @foreach ($studs as $stud)
                      <option value="{{ $stud->id }}">{{ $stud->name }}</option>
                    @endforeach
            </select>
          </div>
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
  <script src="{{ asset('bower_components/select2/dist/js/select2.full.min.js') }}"></script>
  <script>
    $(function () {
      $('.select2').select2()
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
