@extends('admin.layouts.app')

@section('content')
 
<div class="card">
  <div class="card-header">Payments Page</div>
  <div class="card-body">
      
      <form action="{{ url('admin/payments') }}" method="post">
        {!! csrf_field() !!}
        <label>Enrollment Number</label></br>

        <select name="enrollment_id" id="enrollment_id" class="form-control">
          @foreach($enrollment as $id => $enroll_no)
          <option value="{{$id}}">{{$enroll_no}}</option>
          @endforeach
         </select>
  


        <label>Course Name</label></br>

        <label>Paid Date</label></br>
        <input type="date" name="paid_date" id="paid_date" class="form-control"></br>
        
        <label>Amount</label></br>
        <input type="text" name="amount" id="amount" class="form-control"></br>
        <input type="submit" value="Save" class="btn btn-success"></br>
    </form>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
  </div>
</div>
 
@stop