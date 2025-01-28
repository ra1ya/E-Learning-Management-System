@extends('teacher.layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">View Results</div>
        <div class="card-body">
            <h4>{{ $results->student->name }}</h4>
            <p>course name: {{ $results->courses->name }}</p>
            <p>MonthlyTestone: {{ $results->MonthlyTestone }}/20</p>
            <p>MonthlyTestwo: {{ $results->MonthlyTestwo }}/20</p>
             <p>final: {{ $results->final }}/50</p>
            <p>homeworkone: {{ $results->homeworkone }}/5</p>
            <p>homeworktwo: {{ $results->homeworktwo }}/5</p>
            <p>total_marks: {{ $results->total_marks }}%</p>
           
            
            <hr>

         

        </div>
    </div>
@endsection
