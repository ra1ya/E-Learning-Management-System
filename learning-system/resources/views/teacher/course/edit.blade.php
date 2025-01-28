@extends('teacher.layouts.app')

@section('content')
 
<div class="card">
  <div class="card-header">Contactus Page</div>
  <div class="card-body">
      
      <form action="{{ url('teacher/course/' .$courses->id) }}" method="post">
        {!! csrf_field() !!}
        @method("PATCH")
        <input type="hidden" name="id" id="id" value="{{$courses->id}}" id="id" />
        <label>Name</label></br>
        <input type="text" name="name" id="name" value="{{$courses->name}}" class="form-control"></br>
        <label>Syllabus</label></br>
        <input type="text" name="syllabus" id="syllabus" value="{{$courses->syllabus}}" class="form-control"></br>
        <label>Duration</label></br>
        <input type="text" name="duration" id="duration" value="{{$courses->duration}}" class="form-control"></br>
       
        <label>video</label></br>
        <input type="text" name="video_link" id="video_link" value="{{$courses->video_link}}" class="form-control"></br>
       
       
        <label>pdf_file</label></br>
        <input type="text" name="pdf_file" id="pdf_file" value="{{$courses->pdf_file}}" class="form-control"></br>
        <input type="submit" value="Update" class="btn btn-success"></br>
       
      </form>
   
  </div>
</div>
 
@stop