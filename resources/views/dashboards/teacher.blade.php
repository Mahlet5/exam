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
            <span class="label label-primary"><a href="{{ route('course.seasons',['id'=>$course->id]) }}" style="color:#fff;">Classes</a></span>
            <span class="label label-warning"><a href="#" style="color:#fff;">Students</a></span>
            <span class="label label-info"><a href="{{ route('course.materials',['id'=>$course->id]) }}" style="color:#fff;">Materials</a></span>
            <span class="label label-success"><a href="{{ route('course.assignment',['id'=>$course->id]) }}" style="color:#fff;">Assignments</a></span>
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
