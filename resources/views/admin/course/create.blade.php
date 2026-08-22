@extends('admin.layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Courses</div>
    <div class="card-body">
        <form action="{{ route('admin.course.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <label>Course Name</label><br>
            <input type="text" name="name" value="{{ old('name') }}" class="form-control" required><br>
            <label>Syllabus</label><br>
            <textarea name="syllabus" class="form-control" required>{{ old('syllabus') }}</textarea><br>
            <label>Duration</label><br>
            <input type="text" name="duration" value="{{ old('duration') }}" class="form-control" required><br>
            <label>YouTube Video Link</label><br>
            <input type="url" name="video_link" value="{{ old('video_link') }}" class="form-control"><br>
            <label>Upload PDF</label><br>
            <input type="file" name="pdf_file" class="form-control" accept="application/pdf"><br>
            <button type="submit" class="btn btn-success">Add Course</button>
        </form>
    </div>
</div>
@endsection
