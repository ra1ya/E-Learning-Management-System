@extends('teacher.layouts.app')

@section('content')
 
 
<div class="card">
  <div class="card-header">question Page</div>
  <div class="card-body">
   
 
        <div class="card-body">
        <p class="card-title">title  : {{ $question->title }}</p>
            <p class="card-text">Subject Name: {{ $question->subject->name }}</p>
            <p class="card-text">description : {{ $homework->description }}</p>
            <p class="card-text">description : {{ $homework->deadline}}</p>
  </div>
       
    </hr>
  
  </div>
</div>
@endsection 

         
