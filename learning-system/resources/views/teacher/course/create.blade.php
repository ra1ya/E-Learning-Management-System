@extends('teacher.layouts.app')

@section('content')


<div class="card">
  <div class="card-header">Courses Page</div>
  <div class="card-body">
      
    <form action="{{ url('teacher/course') }}" method="post" enctype="multipart/form-data"> <!-- إضافة enctype لرفع الملفات -->
      @csrf
      
      <!-- Course Name -->
      <label>Course Name</label><br>
      <input type="text" name="name" class="form-control" required><br>
      
      <!-- Syllabus -->
      <label>Syllabus</label><br>
      <textarea name="syllabus" class="form-control" required></textarea><br>
  
      <!-- Duration -->
      <label>Duration</label><br>
      <input type="text" name="duration" class="form-control" required><br>
      
      <!-- YouTube Video -->
      <label>YouTube Video Link</label><br>
      <input type="url" name="video_link" class="form-control" placeholder="https://www.youtube.com/watch?v=example"><br>
      
      <!-- PDF Upload -->
      <label>Upload PDF</label><br>
      <input type="file" name="pdf_file" class="form-control" accept=".pdf"><br>

      <!-- Submit Button -->
      <input type="submit" value="Add Course" class="btn btn-success"><br>
    </form>
   
  </div>
</div>
 
@stop
