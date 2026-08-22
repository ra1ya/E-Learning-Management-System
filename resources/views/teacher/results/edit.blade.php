@extends('teacher.layouts.app')

@section('content')

<div class="card">
  <div class="card-header">Page</div>
  <div class="card-body">
      
    <form action="{{ url('teacher/results/' . $results->id) }}" method="post">
      {!! csrf_field() !!}
      @method("PATCH")
      <input type="hidden" name="id" id="id" value="{{ $results->id }}" />
      
      <label>Student Name</label><br>
      <input type="text" class="form-control" value="{{ $results->student->name }}" disabled><br>
      <input type="hidden" name="student_id" id="student_id" value="{{ $results->student->id }}"><br>
  
      <label>Course Name</label><br>
      <input type="text" class="form-control" value="{{ $results->courses->name }}" disabled><br>
      <input type="hidden" name="course_id" id="course_id" value="{{ $results->courses->id }}"><br>
  
      <label>MonthlyTestone</label><br>
      <input type="number" name="MonthlyTestone" id="MonthlyTestone" class="form-control marks-field" value="{{ $results->MonthlyTestone }}"><br>
  
      <label>MonthlyTestwo</label><br>
      <input type="number" name="MonthlyTestwo" id="MonthlyTestwo" class="form-control marks-field" value="{{ $results->MonthlyTestwo }}"><br>
  
      <label>Final</label><br>
      <input type="number" name="final" id="final" class="form-control marks-field" value="{{ $results->final }}"><br>
      
      <label>Homeworkone</label><br>
      <input type="number" name="homeworkone" id="homeworkone" class="form-control marks-field" value="{{ $results->homeworkone }}"><br>
       
      <label>Homeworktwo</label><br>
      <input type="number" name="homeworktwo" id="homeworktwo" class="form-control marks-field" value="{{ $results->homeworktwo }}"><br>
      
      <label>Total Marks</label><br>
      <input type="number" name="total_marks" id="total_marks" class="form-control" value="{{ $results->total_marks }}" readonly><br>
  
      <hr>
  
      <input type="submit" value="Update" class="btn btn-success"><br>
    </form>
  </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const fields = document.querySelectorAll('.marks-field');
        const totalMarksInput = document.getElementById('total_marks');

       
        const calculateTotal = () => {
            let total = 0;
            fields.forEach(field => {
                const value = parseFloat(field.value) || 0; 
                total += value;
            });
            totalMarksInput.value = total;
        };

        fields.forEach(field => {
            field.addEventListener('input', calculateTotal);
        });
    });
</script>

@endsection
