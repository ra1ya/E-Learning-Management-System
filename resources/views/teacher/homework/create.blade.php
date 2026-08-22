@extends('teacher.layouts.app')

@section('content')

<div class="card">
  <div class="card-header">Homework Page</div>
  <div class="card-body">

      <form action="{{ url('teacher/homework') }}" method="post">
        @csrf

        <!-- Homework Title -->
        <label for="title">Homework Title</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
        @error('title')
        <div class="text-danger">{{ $message }}</div>
        @enderror
        <br>

        <!-- Subject Name -->
        <label for="course_id">courses Name</label>
        <select name="course_id" id="course_id" class="form-control" required>
          <option value="">Select courses</option>
          @foreach($courses as $id => $name)
          <option value="{{ $id }}" {{ old('course_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
          @endforeach
        </select>
        @error('course_id')
        <div class="text-danger">{{ $message }}</div>
        @enderror
        <br>

        <!-- Deadline -->
        <label for="deadline">Deadline</label>
        <input type="datetime-local" name="deadline" id="deadline" class="form-control" value="{{ old('deadline') }}" required>
        @error('deadline')
        <div class="text-danger">{{ $message }}</div>
        @enderror
        <br>

        <!-- Description -->
        <label for="description">Description</label>
        <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description') }}</textarea>
        @error('description')
        <div class="text-danger">{{ $message }}</div>
        @enderror
        <br>

        <!-- Questions Section -->
        <h5>Question</h5>
        <div id="questionsContainer">
          <div class="question-block" data-index="0">
            <!-- Question Text -->
            <label for="question[0][text]">Question Text</label>
            <textarea name="question[0][text]" class="form-control" rows="2" required></textarea>
            <br>

            <!-- Question Type -->
            <label for="question[0][type]">Answer Type</label><br>
            <select name="question[0][type]" class="form-control" required>
              <option value="text">Text</option>
              <option value="radio">Multiple Choice (Single Answer)</option>
              <option value="checkbox">Multiple Choice (Multiple Answers)</option>
            </select>
            <br>

            <!-- Options Section -->
            <label for="question[0][options][]">Options</label>
            <div id="optionsContainer0">
              <input type="text" name="question[0][options][]" class="form-control" placeholder="Option 1">
              <input type="text" name="question[0][options][]" class="form-control" placeholder="Option 2">
              <input type="text" name="question[0][options][]" class="form-control" placeholder="Option 3">
            </div>
            <!-- تحديد الإجابة الصحيحة -->
<label for="question[0][correct_answers][]">Correct Answer(s)</label>
<input type="text" name="question[0][correct_answers][]" class="form-control" placeholder="Correct Answer">

<label for="question[0][marks]">Marks</label>
<input type="number" name="question[0][marks]" class="form-control" value="1" min="1" required>
<br>

            <button type="button" onclick="addOption(0)" class="btn btn-secondary">Add Option</button>
            <br><br>
          </div>
        </div>

        <!-- Add Question Button -->
        <button type="button" id="addQuestionButton" class="btn btn-primary">Add Question</button>
        <br/><br/>

        <!-- Submit Button -->
        <input type="submit" value="Save" class="btn btn-success">
    </form>

    @if ($errors->any())
    <div class="alert alert-danger mt-3">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

  </div>
</div>

<script>
    // Add dynamic question fields
    let questionIndex = 1;

    // Event listener for adding new questions
   // Event listener for adding new questions
   document.getElementById('addQuestionButton').addEventListener('click', function() {
    const container = document.getElementById('questionsContainer');
    const questionBlock = `
      <div class="question-block" data-index="${questionIndex}">
        <hr>
        <label for="question[${questionIndex}][text]">Question Text</label>
        <textarea name="question[${questionIndex}][text]" class="form-control" rows="2" required></textarea>
        <br>

        <label for="question[${questionIndex}][type]">Answer Type</label><br>
        <select name="question[${questionIndex}][type]" class="form-control" required>
          <option value="text">Text</option>
          <option value="radio">Multiple Choice (Single Answer)</option>
          <option value="checkbox">Multiple Choice (Multiple Answers)</option>
        </select>
        <br>

        <label for="question[${questionIndex}][options][]">Options</label>
        <div id="optionsContainer${questionIndex}">
          <input type="text" name="question[${questionIndex}][options][]" class="form-control" placeholder="Option 1">
          <input type="text" name="question[${questionIndex}][options][]" class="form-control" placeholder="Option 2">
          <input type="text" name="question[${questionIndex}][options][]" class="form-control" placeholder="Option 3">
        </div>
        
        <button type="button" onclick="addOption(${questionIndex})" class="btn btn-secondary">Add Option</button>
        <br>

        <!-- Correct Answer Field -->
      <label for="question[${questionIndex}][correct_answers][]">Correct Answer(s)</label>
<input type="text" name="question[${questionIndex}][correct_answers][]" class="form-control" placeholder="Correct Answer">

        <br>
        
         <label for="question[${questionIndex}][marks]">Marks</label>
    <input type="number" name="question[${questionIndex}][marks]" class="form-control" value="1" min="1" required>
    <br>

      </div>`;
    
    container.insertAdjacentHTML('beforeend', questionBlock);
    questionIndex++;
});

    
</script>

@endsection
