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
      <h3 class="box-title">{{ $course->title }} Materials</h3>
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
          <th>Description</th>
          <th>File</th>
          <th>Delete</th>
        </tr>
        </thead>
        <tbody>
          @foreach ($materials as $material)
            <tr>
              <td>{{ $material->season->title }}</td>
              <td>{{ $course->title }}</td>
              <td>{!! $material->description !!}</td>
              <td><a href="{{ asset($material->path) }}"><i class="glyphicon glyphicon-download-alt"></i></a></td>
              <td>
                {{-- <a href="{{ route('class.students',['id'=>$season->id,'course'=>$course->id]) }}" class="btn btn-xs btn-info">
                                  students</span>
                </a> --}}
              </td>
              <td>
                {{-- <a href="{{ route('course.delete',['id'=>$season->id,'course'=>$course->id]) }}" class="btn btn-xs btn-danger">
                                  <span class="glyphicon glyphicon-trash"></span>
                </a> --}}
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
      <h3 class="box-title">Upload New Material</h3>
      {{-- <a href="{{ route('user.create') }}" style="float:right;" class="btn btn-xs btn-success">
                        Create</span>
      </a> --}}
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form class="form-horizontal" method="POST" action="{{ route('material.store') }}" enctype="multipart/form-data">
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
