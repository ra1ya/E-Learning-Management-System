@extends('admin.layouts.app')

@section('content')
 
<div class="card">
  <div class="card-header">courses Page</div>
  <div class="card-body">
      
    <form action="{{ url('admin/course') }}" method="post">
      {!! csrf_field() !!}
      <label>courses Name</label><br>
      <input type="text" name="name" class="form-control" required><br>
      
      <label>Syllabus</label><br>
      <textarea name="syllabus" class="form-control" required></textarea><br>
  
      <label>Duration</label><br>
      <input type="text" name="duration" class="form-control" required><br> 
  
         
     
      <label>YouTube Video Link</label><br>
      <input type="url" name="video_link" class="form-control" placeholder="https://www.youtube.com/watch?v=example"><br>
      
    
      <label>Upload PDF</label><br>
      <input type="file" name="pdf_file" class="form-control" accept=".pdf"><br>




      <input type="submit" value="Add Course" class="btn btn-success"><br>
  </form>
  
   
  </div>
</div>
 
@stop