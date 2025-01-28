@extends('teacher.layouts.app')

@section('content')
 
<div class="card">
  <div class="card-header">test Page</div>
  <div class="card-body">
      
    <form action="{{ url('teacher/test/' .$test->id) }}" method="post">
      {!! csrf_field() !!}
      @method("PATCH")
      <input type="hidden" name="id" id="id" value="{{$test->id}}" />
      
      <label>Title</label></br>
      <input type="text" name="title" id="title" class="form-control" value="{{$test->title}}"></br>
  
      <label>course Name</label></br>
      <input type="text" class="form-control" value="{{$test->courses->name}}" disabled></br>
      <input type="hidden" name="course_id" id="course_id" value="{{$test->courses->id}}"></br>
  
      <label>Description</label></br>
      <input type="text" name="description" id="description" class="form-control" value="{{$test->description}}"></br>
  
      <label>Deadline</label></br>
      <input type="text" name="deadline" id="deadline" class="form-control" value="{{$test->deadline}}"></br>
  
      <h5>Questions</h5>
      @foreach($test->testques as $testques)
          <div class="testques">
              <label>testques</label></br>
              <input type="text" name="testques[]" id="testques" class="form-control" value="{{$testques->text}}"></br>
  
              <label>Type</label></br>
              <input type="text" name="testques[]" id="testques" class="form-control" value="{{$testques->type}}"></br>
  
              @if($testques->options)
                  <p><strong>Options:</strong></p>
                  <ul>
                      @foreach(json_decode($testques->options) as $option)
                          <input type="text" name="testques[options][]" class="form-control" value="{{$option}}"></br>
                      @endforeach
                  </ul>
              @endif

              @if($testques->correct_answers)
              <p><strong>correct answers:</strong></p>
              <ul>
                  @foreach(json_decode($testques->correct_answers) as $correct_answers)
                      <input type="text" name="testques[correct_answers][]" class="form-control" value="{{$correct_answers}}"></br>
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