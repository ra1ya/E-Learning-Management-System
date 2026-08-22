@extends('admin.layouts.app')

@section('content')
 
 
<div class="card">
  <div class="card-header">Batches Page</div>
  <div class="card-body">
   
 
        <div class="card-body">
        <h5 class="card-title">Enrollment no : {{ $payments->enrollment->enroll_no }}</h5>
        <p class="card-text">Paid Date  : {{ $payments->paid_date }}</p>
        <p class="card-text">Amount : {{ $payments->amount }}</p>

      
  </div>
       
    </hr>
  
  </div>
</div>
@endsection 
