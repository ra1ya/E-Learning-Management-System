@extends('teacher.layouts.app')

@section('content')
 
<div class="card">
  <div class="card-header">Question Page</div>
  <div class="card-body">
      
      <form action="{{ url('teacher/question/' .$question->id) }}" method="post">
        {!! csrf_field() !!}
        @method("PATCH")
        <input type="hidden" name="id" id="id" value="{{$question->id}}" />

        <!-- حقل النص -->
        <label>Text</label></br>
        <input type="text" name="text" id="text" class="form-control" value="{{$question->text}}"></br>

        <!-- نوع السؤال -->
        <label>Type</label></br>
        <input type="text" name="type" id="type" class="form-control" value="{{$question->type}}"></br>
         
        <!-- قائمة الخيارات القابلة للتعديل -->
        <label>Options</label></br>
        <div id="options-container">
            @php
                $currentOptions = json_decode($question->options) ?? [];
            @endphp

            @foreach ($currentOptions as $key => $option)
                <div class="option-item" style="margin-bottom: 10px;">
                    <input type="text" name="options[]" class="form-control d-inline-block" value="{{ $option }}" style="width: 90%; display: inline-block;" />
                    <button type="button" class="btn btn-danger btn-sm remove-option" style="display: inline-block;">Remove</button>
                </div>
            @endforeach
        </div>

        <!-- زر لإضافة خيارات جديدة -->
        <button type="button" id="add-option" class="btn btn-primary btn-sm" style="margin-top: 10px;">Add Option</button>
        </br></br>
        
        <!-- زر التحديث -->
        <input type="submit" value="Update" class="btn btn-success"></br>
    </form>
  </div>
</div>
 
<script>
    // إضافة خيار جديد
    document.getElementById('add-option').addEventListener('click', function() {
        const container = document.getElementById('options-container');
        const newOption = document.createElement('div');
        newOption.className = 'option-item';
        newOption.style.marginBottom = '10px';
        newOption.innerHTML = `
            <input type="text" name="options[]" class="form-control d-inline-block" style="width: 90%; display: inline-block;" />
            <button type="button" class="btn btn-danger btn-sm remove-option" style="display: inline-block;">Remove</button>
        `;
        container.appendChild(newOption);
    });

    // إزالة خيار
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-option')) {
            e.target.parentElement.remove();
        }
    });
</script>
 
@stop
