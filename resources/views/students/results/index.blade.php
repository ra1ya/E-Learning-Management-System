@extends('students.layouts.app')

@section('content')
<div class="content">
    <div class="card-header">
        <h2>Student Performance</h2>
    </div>
    <div class="card-body" style="background-color: white">
       
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
                    @forelse ($results as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->student->name }}</td>
                        <td>{{ $data->courses->name ?? 'No Course Name' }}</td>
                        <td>{{ $data->MonthlyTestone ?? 'No Data' }} / 20</td>
                        <td>{{ $data->MonthlyTestwo ?? 'No Data' }} / 20</td>
                        <td>{{ $data->final ?? 'No Data' }} / 50</td>
                        <td>{{ $data->homeworkone }} / 5</td>
                        <td>{{ $data->homeworktwo }} / 5</td>
                        <td>{{ $data->total_marks }}%</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9">No results found for the current student.</td>
                    </tr>
                @endforelse
                
                
                
                </tbody>
                <style>
       
                </style>
            </table>
        </div>
    </div>
</div>
@endsection
