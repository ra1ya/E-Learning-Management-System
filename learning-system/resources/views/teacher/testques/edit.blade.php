@extends('teacher.layouts.app')

@section('content')
 
<div class="card">
  <div class="card-header">homework Page</div>
  <div class="card-body">
      
    <form action="{{ url('teacher/homework/' .$homework->id) }}" method="post">
      {!! csrf_field() !!}
      @method("PATCH")
      <input type="hidden" name="id" id="id" value="{{$homework->id}}" />
      
      <label>Title</label></br>
      <input type="text" name="title" id="title" class="form-control" value="{{$homework->title}}"></br>
  
      <label>course Name</label></br>
      <input type="text" class="form-control" value="{{$homework->course->name}}" disabled></br>
      <input type="hidden" name="course_id" id="course_id" value="{{$homework->course->id}}"></br>
  
      <label>Description</label></br>
      <input type="text" name="description" id="description" class="form-control" value="{{$homework->description}}"></br>
  
      <label>Deadline</label></br>
      <input type="text" name="deadline" id="deadline" class="form-control" value="{{$homework->deadline}}"></br>
  
      <h5>Questions</h5>
      @foreach($homework->question as $question)
          <div class="question">
              <label>Question</label></br>
              <input type="text" name="question[]" id="question" class="form-control" value="{{$question->text}}"></br>
  
              <label>Type</label></br>
              <input type="text" name="question[]" id="question" class="form-control" value="{{$question->type}}"></br>
  
              @if($question->options)
                  <p><strong>Options:</strong></p>
                  <ul>
                      @foreach(json_decode($question->options) as $option)
                          <input type="text" name="question[options][]" class="form-control" value="{{$option}}"></br>
                      @endforeach
                  </ul>
              @endif

              @if($question->correct_answers)
              <p><strong>correct answers:</strong></p>
              <ul>
                  @foreach(json_decode($question->correct_answers) as $correct_answers)
                      <input type="text" name="question[correct_answers][]" class="form-control" value="{{$correct_answers}}"></br>
                  @endforeach
              </ul>
          @endif
          </div>
          <hr>
      @endforeach
  
      <input type="submit" value="Update" class="btn btn-success"></br>
  </form>
  

  





   
  </div>
</div>
 
@stop