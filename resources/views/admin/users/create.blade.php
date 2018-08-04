@extends('layouts.frontend')
@section('content')

@include('admin.includes.errors')
<div class="col-md-6">
<div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title">Create User</h3>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
  <form class="form-horizontal" method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="box-body">
      <div class="form-group">
        <label for="fullname" class="col-sm-2 control-label">Full Name</label>

        <div class="col-sm-10">
          <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Full Name">
        </div>
      </div>
      <div class="form-group">
        <label for="email" class="col-sm-2 control-label">Email</label>

        <div class="col-sm-10">
          <input type="email" class="form-control" id="email" name="email" placeholder="Email">
        </div>
      </div>
      <div class="form-group">
        <label for="phone" class="col-sm-2 control-label">Phone</label>

        <div class="col-sm-10">
          <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
                  <input type="text" id="phone" name="phone" class="form-control required"
                         data-inputmask='"mask": "(999) 999-99-99-99"' data-mask>
                </div>
        </div>
      </div>
      <div class="form-group">
        <label for="role" class="col-sm-2 control-label">Role</label>

        <div class="col-sm-10">
          <select name="role" class="form-control" id="role">
            @foreach ($roles as $role)
              <option value="{{ $role->id }}">{{ $role->name }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="form-group" id="render_region" style="display:none" >
        <label for="region_select" class="col-sm-2 control-label">Region</label>
        <div class="col-sm-10">
          <select class="form-control select2" id="region_select" name ="region_select">
                    <option value="0" selected="selected">--Select Region --</option>
          </select>
        </div>
      </div>
      <div class="form-group" id="render_woreda" style="display:none">
        <label for="woreda_select" class="col-sm-2 control-label">Woreda</label>
        <div class="col-sm-10">
          <select class="form-control select2" id="woreda_select" name ="woreda_select">
                    <option value="0" selected="selected">--Select Woreda --</option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label for="featured" class="col-sm-2 control-label">Picture</label>

        <div class="col-sm-10">
          <input type="file" class="form-control" id="featured" name="featured">
        </div>
      </div>


    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      {{-- <button type="submit" class="btn btn-default">Cancel</button> --}}
      <button type="submit" class="btn btn-success pull-right">Save</button>
    </div>
    <!-- /.box-footer -->
  </form>
</div>
</div>

<div class="col-md-6" id="image-holder">
</div>
</div>



@endsection
@section('postscripts')
<script>
  $('#role').change(function(){
    var selectedValue = $("#role option:selected").text();
    if(selectedValue.indexOf("Region") >= 0) {
          $("#render_region").css("display","block");
          $.ajax({
              url:'/loadRegion',
              data:{option:selectedValue},
              method:"GET",
              success: function(data) {
                $('#region_select').html(data);
              }
            });
    }
    else if (selectedValue.indexOf("Woreda") >= 0){
          $("#render_region").css("display","block");
          $.ajax({
              url:'/loadRegion',
              data:{option:selectedValue},
              method:"GET",
              success: function(data) {
                $('#region_select').html(data);
              }
            });
          $("#render_woreda").css("display","block");
    }
    else if (selectedValue.indexOf("Technical") >= 0){
          $("#render_region").css("display","block");
          $.ajax({
              url:'/loadRegion',
              data:{option:selectedValue},
              method:"GET",
              success: function(data) {
                $('#region_select').html(data);
              }
            });
          $("#render_woreda").css("display","block");
    }
     else {
          $('#region_select').prop('selectedIndex',0);
          $('#woreda_select').prop('selectedIndex',0);
          $("#render_region").css("display","none");
          $("#render_woreda").css("display","none");
    }
  });

  $('#region_select').change(function(){
    var selectedRole = $("#role option:selected").text();
    if (selectedRole.indexOf( "Woreda") >= 0 || selectedRole.indexOf( "TTL") >= 0){
        var selectedValue = $("#region_select option:selected").val();
        $.ajax({
            url:'/loadWoreda/'+ selectedValue,
            data:{option:selectedValue},
            method:"GET",
            success: function(data) {
              $('#woreda_select').html(data);
            }
          });
    }
  });


  $("#featured").on('change', function () {

     //Get count of selected files
     var countFiles = $(this)[0].files.length;

     var imgPath = $(this)[0].value;
     var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
     var image_holder = $("#image-holder");
     image_holder.empty();

     if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
         if (typeof (FileReader) != "undefined") {

             //loop for each file selected for uploaded.
             for (var i = 0; i < countFiles; i++) {

                 var reader = new FileReader();
                 reader.onload = function (e) {
                     $("<img />", {
                         "src": e.target.result,
                            "class" : "img-responsive"
                     }).appendTo(image_holder);
                 }


                 image_holder.show();
                 reader.readAsDataURL($(this)[0].files[i]);
             }

         } else {
             alert("This browser does not support FileReader.");
         }
     } else {
         alert("Please select only images");
     }
 });
</script>
@endsection
