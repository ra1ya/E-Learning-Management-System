@extends('teacher.layouts.app')

@section('content')

<div class="card">
    <div class="card-header">Results Page</div>
    <div class="card-body">
        <form action="{{ route('teacher.results.store') }}" method="POST">
            @csrf
            <table border="1" cellspacing="0" cellpadding="5" style="width: 100%; text-align: left;">
                <tbody>
                    <label>Student Name</label><br>
                    <select name="student_id" id="student_id" class="form-control">
                        @foreach($students as $id => $name)
                        <option value="{{$id}}">{{$name}}</option>
                        @endforeach
                    </select>
                    <br>

                 
                    <label>Course Name</label><br>
                    <select name="course_id" id="course_id" class="form-control">
                        @foreach($courses as $id => $name)
                        <option value="{{$id}}">{{$name}}</option>
                        @endforeach
                    </select>
                    <br>

              
                    <label>MonthlyTestone</label><br>
                    <input type="number" name="MonthlyTestone" id="MonthlyTestone" class="form-control marks-field" min="0" required><br>

                 
                    <label>MonthlyTestwo</label><br>
                    <input type="number" name="MonthlyTestwo" id="MonthlyTestwo" class="form-control marks-field" min="0" required><br>

                   
                    <label>Final</label><br>
                    <input type="number" name="final" id="final" class="form-control marks-field" min="0" required><br>

                   
                    <label>Homeworkone</label><br>
                    <input type="number" name="homeworkone" id="homeworkone" class="form-control marks-field" min="0" required><br>

                   
                    <label>Homeworktwo</label><br>
                    <input type="number" name="homeworktwo" id="homeworktwo" class="form-control marks-field" min="0" required><br>

                    <label>Total Marks</label><br>
                    <input type="number" name="total_marks" id="total_marks" class="form-control" readonly required><br>

            
                    <input type="submit" value="Add Result" class="btn btn-success"><br>
                </tbody>
            </table>
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
