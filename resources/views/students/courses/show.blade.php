@extends('students.layouts.app')

@section('content')

<div class="card">
  <div class="card-header">{{ $courses->name }}</div>
  <div class="card-body">
    <h5>Syllabus:</h5>
    <p>{{ $courses->syllabus }}</p>

    <h5>Duration:</h5>
    <p>{{ $courses->duration }}</p>

    @if($courses->video_link)
    <h5>Video:</h5>
    <br/>
    <iframe width="560" height="315" src="{{ str_replace('watch?v=', 'embed/', $courses->video_link) }}" frameborder="0" allowfullscreen></iframe>
    @endif

    @if($courses->pdf_file)
    <h5>PDF:</h5>
    <a href="{{ Storage::url($courses->pdf_file) }}" target="_blank" class="btn btn-primary">View PDF</a>
    @endif
  </div>
</div>

@endsection
