@extends('admin.layouts.app')

@section('content')
 
<div class="card">
  <div class="card-header">Batches Page</div>
  <div class="card-body">
      
      <form action="{{ url('admin/batches') }}" method="post">
        {!! csrf_field() !!}
        <label>Batche Name</label></br>
        <input type="text" name="name" id="name" class="form-control"></br>


        <label>Course Name</label></br>

       <select name="course_id" id="course_id" class="form-control">
        @foreach($courses as $id => $name)
        <option value="{{$id}}">{{$name}}</option>
        @endforeach
       </select>

        <label>Start Date</label></br>
        <input type="date" name="start_date" id="start_date" class="form-control"></br>

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