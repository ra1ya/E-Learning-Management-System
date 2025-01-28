@extends('teacher.layouts.app')

@section('content')
<div class="content">
    <div class="card-header">
        <h2>Student Performance</h2>
    </div>
    <div class="card-body" style="background-color: white">
        <a href="{{ route('teacher.results.create') }}" class="btn btn-success btn-sm"> Add New result</a>
        <br/><br/>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Student Name</th>
                        <th>Course Name</th>
                        <th>Monthly Test 1</th>
                        <th>Monthly Test 2</th>
                        <th>Final Test</th>
                        <th>Homework 1</th>
                        <th>Homework 2</th>
                        <th>Total Marks</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($results as $data)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $data->student->name }}</td>
        <td>{{ $data->courses->name ?? 'No Course Name' }}</td>
        <td>{{ $data->MonthlyTestone ?? 'No Course Name' }} / 20</td>
        <td>{{ $data->MonthlyTestwo  ?? 'No Course Name'  }} / 20</td>
        <td>{{ $data->final ?? 'No Course Name'}} / 50</td>
        <td>{{ $data->homeworkone }} / 5</td>
        <td>{{ $data->homeworktwo }} / 5</td>
        <td>{{ $data->total_marks }}%</td>
        <td>
            <a href="{{ route('teacher.results.show', $data->id) }}" class="btn btn-info btn-sm">
                <i class="fa fa-eye"></i> View
            </a>
            <a href="{{ route('teacher.results.edit', $data->id) }}" class="btn btn-primary btn-sm">
                <i class="fa fa-edit"></i> Edit
            </a>
            <form method="POST" action="{{ route('teacher.results.destroy', $data->id) }}" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                    <i class="fa fa-trash"></i> Delete
                </button>
            </form>
        </td>
    </tr>
@endforeach

                
                
                
                </tbody>
            </table>
        </div>
    </div>
</div>
<style>
    .content {
         
        padding-left: 130px;
        padding-top: 90px;
        padding-bottom: 150px;
       
        position: relative; 
        z-index: 0;
       width: 1480px;
        
    }
</style>
@endsection
