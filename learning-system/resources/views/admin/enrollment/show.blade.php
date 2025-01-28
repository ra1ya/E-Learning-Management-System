@extends('admin.layouts.app')

@section('content')
 
 
<div class="card">
  <div class="card-header">enrollment Page</div>
  <div class="card-body">
   
 
        <div class="card-body">
        <h5 class="card-title">enroll no : {{ $enrollment->enroll_no }}</h5>
        <p class="card-text">batch : {{ $enrollment->batch->name }}</p>
        <p class="card-text">student : {{ $enrollment->student->name}}</p>
        <p class="card-text">join date : {{ $enrollment->join_date }}</p>
        <p class="card-text">fee : {{ $enrollment->fee }}</p>
  </div>
       
    </hr>
  
  </div>
</div>
@endsection 
