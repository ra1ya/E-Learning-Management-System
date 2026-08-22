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
        <label for="subject_id">Subject Name</label>
        <select name="subject_id" id="subject_id" class="form-control" required>
          <option value="">Select Subject</option>
          @foreach($subjects as $id => $name)
          <option value="{{ $id }}" {{ old('subject_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
          @endforeach
        </select>
        @error('subject_id')
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

          <!-- حقل الخيارات -->
<label for="question[0][options][]">Options</label>
<div id="optionsContainer0">
  <input type="text" name="question[0][options][]" class="form-control" placeholder="Option 1">
  <input type="text" name="question[0][options][]" class="form-control" placeholder="Option 2">
  <input type="text" name="question[0][options][]" class="form-control" placeholder="Option 3">
</div>
<button type="button" onclick="addOption(0)" class="btn btn-secondary">Add Option</button>


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

    document.getElementById('addQuestionButton').addEventListener('click', function() {
        const container = document.getElementById('questionsContainer');
        const questionBlock = `
          <div class="question-block" data-index="${questionIndex}">
            <hr>
            <label for="questions[${questionIndex}][text]">Question Text</label>
            <textarea name="questions[${questionIndex}][text]" class="form-control" rows="2" required></textarea>
            <br>

            <label for="questions[${questionIndex}][type]">Answer Type</label><br>
            <select name="questions[${questionIndex}][type]" class="form-control" required>
              <option value="text">Text</option>
              <option value="radio">Multiple Choice (Single Answer)</option>
              <option value="checkbox">Multiple Choice (Multiple Answers)</option>
            </select>
            <br>

            <label for="questions[${questionIndex}][options]">Options (comma-separated)</label>
            <textarea name="questions[${questionIndex}][options]" class="form-control" rows="2" placeholder="Option 1, Option 2, Option 3"></textarea>
            <small class="text-muted">Leave blank for text-based answers.</small>
            <br><br>
          </div>`;
        container.insertAdjacentHTML('beforeend', questionBlock);
        questionIndex++;


        function addOption(questionIndex) {
    const container = document.getElementById(`optionsContainer${questionIndex}`);
    const newInput = document.createElement('input');
    newInput.type = 'text';
    newInput.name = `question[${questionIndex}][options][]`;
    newInput.className = 'form-control';
    newInput.placeholder = `Option ${container.children.length + 1}`;
    container.appendChild(newInput);
}

    });
</script>

@endsection
