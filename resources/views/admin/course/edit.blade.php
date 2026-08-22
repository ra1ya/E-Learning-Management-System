@extends('admin.layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Edit Course</div>
    <div class="card-body">
        <form action="{{ route('admin.course.update', $courses) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <label>Name</label><br>
            <input type="text" name="name" value="{{ old('name', $courses->name) }}" class="form-control" required><br>
            <label>Syllabus</label><br>
            <textarea name="syllabus" class="form-control" required>{{ old('syllabus', $courses->syllabus) }}</textarea><br>
            <label>Duration</label><br>
            <input type="text" name="duration" value="{{ old('duration', $courses->duration) }}" class="form-control" required><br>
            <label>YouTube Video Link</label><br>
            <input type="url" name="video_link" value="{{ old('video_link', $courses->video_link) }}" class="form-control"><br>
            <label>Replace PDF (optional)</label><br>
            <input type="file" name="pdf_file" class="form-control" accept="application/pdf"><br>
            @if($courses->pdf_file)<small>Current file: {{ $courses->pdf_file }}</small><br><br>@endif
            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
</div>
@endsection
