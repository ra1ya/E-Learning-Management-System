@extends('teacher.layouts.app')

@section('content')

<div class="card">
  <div class="card-header">Test Page</div>
  <div class="card-body">

    <form action="{{ route('teacher.test.store') }}" method="POST">
      @csrf

     
      <label for="title">Test Title</label>
      <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
      @error('title')
      <div class="text-danger">{{ $message }}</div>
      @enderror
      <br>

 
      <label for="course_id">Course Name</label>
      <select name="course_id" id="course_id" class="form-control" required>
        <option value="">Select Course</option>
        @foreach($courses as $id => $name)
        <option value="{{ $id }}" {{ old('course_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
        @endforeach
      </select>
      @error('course_id')
      <div class="text-danger">{{ $message }}</div>
      @enderror
      <br>

      
      <label for="deadline">Deadline</label>
      <input type="datetime-local" name="deadline" id="deadline" class="form-control" value="{{ old('deadline') }}" required>
      @error('deadline')
      <div class="text-danger">{{ $message }}</div>
      @enderror
      <br>

      
      <label for="description">Description</label>
      <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description') }}</textarea>
      @error('description')
      <div class="text-danger">{{ $message }}</div>
      @enderror
      <br>

    
      <h5>Questions</h5>
   
<div id="questionsContainer">
  <div class="question-block" data-index="0">
      <label for="testques[0][text]">Question Text</label>
      <textarea name="testques[0][text]" class="form-control" rows="2" required></textarea>
      <br>

      <label for="testques[0][type]">Answer Type</label>
      <select name="testques[0][type]" class="form-control" required>
          <option value="text">Text</option>
          <option value="radio">Multiple Choice (Single Answer)</option>
          <option value="checkbox">Multiple Choice (Multiple Answers)</option>
      </select>
      <br>

      <label for="testques[0][options][]">Options</label>
<div id="optionsContainer0">
    <input type="text" name="testques[0][options][]" class="form-control" placeholder="Option 1">
    <input type="text" name="testques[0][options][]" class="form-control" placeholder="Option 2">
    <input type="text" name="testques[0][options][]" class="form-control" placeholder="Option 3">
</div>
<button type="button" onclick="addOption(0)" class="btn btn-secondary">Add Option</button>
<br><br>

      <label for="testques[0][correct_answers][]">Correct Answer(s)</label>
      <input type="text" name="testques[0][correct_answers][]" class="form-control" placeholder="Correct Answer">
      <br>

      <label for="testques[0][marks]">Marks</label>
      <input type="number" name="testques[0][marks]" class="form-control" value="1" min="1" required>
      <br>
  </div>
</div>

      <button type="button" id="addQuestionButton" class="btn btn-primary">Add Question</button>
      <br><br>

 
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
 let questionIndex = 1;


document.getElementById('addQuestionButton').addEventListener('click', function() {
    const container = document.getElementById('questionsContainer');
    const questionBlock = `
      <div class="question-block" data-index="${questionIndex}">
        <hr>
        <label for="testques[${questionIndex}][text]">Question Text</label>
        <textarea name="testques[${questionIndex}][text]" class="form-control" rows="2" required></textarea>
        <br>

        <label for="testques[${questionIndex}][type]">Answer Type</label>
        <select name="testques[${questionIndex}][type]" class="form-control" required>
            <option value="text">Text</option>
            <option value="radio">Multiple Choice (Single Answer)</option>
            <option value="checkbox">Multiple Choice (Multiple Answers)</option>
        </select>
        <br>

        <label for="testques[${questionIndex}][options][]">Options</label>
        <div id="optionsContainer${questionIndex}">
            <input type="text" name="testques[${questionIndex}][options][]" class="form-control" placeholder="Option 1">
            <input type="text" name="testques[${questionIndex}][options][]" class="form-control" placeholder="Option 2">
        </div>
        <button type="button" onclick="addOption(${questionIndex})" class="btn btn-secondary">Add Option</button>
        <br><br>

        <label for="testques[${questionIndex}][correct_answers][]">Correct Answer(s)</label>
        <input type="text" name="testques[${questionIndex}][correct_answers][]" class="form-control" placeholder="Correct Answer">
        <br>

        <label for="testques[${questionIndex}][marks]">Marks</label>
        <input type="number" name="testques[${questionIndex}][marks]" class="form-control" value="1" min="1" required>
        <br>
      </div>`;
    container.insertAdjacentHTML('beforeend', questionBlock);
    questionIndex++;
});


function addOption(questionIndex) {
    const optionsContainer = document.getElementById(`optionsContainer${questionIndex}`);
    const optionInput = document.createElement('input');
    optionInput.type = 'text';
    optionInput.name = `testques[${questionIndex}][options][]`;
    optionInput.className = 'form-control';
    optionInput.placeholder = `Option ${optionsContainer.children.length + 1}`;
    optionsContainer.appendChild(optionInput);
}

</script>

@endsection
