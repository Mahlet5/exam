@extends('layouts.frontend')

@section('content')
  <div class="alert alert-success" role="alert">
    Class of <b>{{ $season->title }}</b> on {{ $course->title }} | Student sheet.
  </div>
@endsection
