@extends('layouts.frontend')
@section('poststyles')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
  <link href="{{ asset('css/summernote.css') }}" rel="stylesheet"></link>
@endsection
@section('content')
    <div class="col-md-6">
  <div class="box box-primary">
    <div class="box-header  with-border">
      <h3 class="box-title">{{ $course->title }} Assignmnets</h3>
     
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>Class</th>
          <th>Course</th>
         
          <th>Description</th>
          <th>File</th>
          <th>Due_date</th>
          <th>Delete</th>
        </tr>
        </thead>
        <tbody>
          @foreach ($assignments as $assignment)
            <tr>
              <td>{{ $assignment->season->title }}</td>
              <td>{{ $course->title }}</td>
              <td>{!! $assignment->description !!}</td>
              <td><a href="{{ asset($assignment->path) }}"><i class="glyphicon glyphicon-download-alt"></i></a></td>
              <td>
               
              </td>
              <td>
                <a href="{{ route('assignmnet.delete',['id'=>$assignment->id,'course'=>$course->id]) }}" class="btn btn-xs btn-danger">
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
      <h3 class="box-title">Upload New Assignment</h3>
      
    </div>
    <!-- /.box-header -->
    <div class="box-body">
   
      <form class="form-horizontal" method="POST" action="{{ route('assignment.store') }}" enctype="multipart/form-data">

        {{ csrf_field() }}
        <div class="form-group">
          <label for="mclass" class="col-sm-2 control-label">Class</label>

          <div class="col-sm-10">
            <select class="form-control" id="mclass" name="mclass">
              @foreach ($seasons as $season)
                <option value="{{ $season->id }}">{{ $season->title }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="document" class="col-sm-2 control-label">Document</label>

          <div class="col-sm-10">
            <input type="file" name="document" id="document">
          </div>
        </div>


        <div class="form-group">
          <label for="desciption" class="col-sm-2 control-label">Description</label>

          <div class="col-sm-10">
            <textarea class="form-control" name="description" id="description"></textarea>
          </div>
          <div class="form-group">
        <label for="Due_date" class="col-sm-2 control-label">Due date</label>
        <div class="col-sm-10">
        <form action="/action_page.php">
        <input type="date" name="Due_date" id="Due_date">
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
  <script type="text/javascript" src="{{ asset('js/summernote.min.js') }}"></script>
  <script>
    $(document).ready(function() {
        $('#description').summernote();
    });
  </script>
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
