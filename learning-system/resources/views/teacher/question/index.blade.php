@extends('teacher.layouts.app')

@section('content')
<br/>
<div class="content">
    <div class="card-header">
        <h2>Question Management</h2>
    </div>
    <div class="card-body" style="background-color: white">
        <a href="{{ route('teacher.question.create') }}" class="btn btn-success btn-sm"> Add New question</a>
        <br/><br/>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Text</th>
                        <th>Type</th>
                        <th>Options</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($question as $assignment)
                    <tr>
                        
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $assignment->homework->title }}</td> 
                        <td>{{ $assignment->text }}</td>
                         <td>{{ $assignment->type }}</td>
                         <td>{{ $assignment->options }}</td>
               
                       
                   
                        <td>
                            <a href="{{ route('teacher.question.show', $assignment->id) }}" class="btn btn-info btn-sm">
                                <i class="fa fa-eye"></i> View
                            </a>
                            <a href="{{ route('teacher.question.edit', $assignment->id) }}" class="btn btn-primary btn-sm">
                                <i class="fa fa-edit"></i> Edit
                            </a>
                            <form method="POST" action="{{ route('teacher.homework.destroy', $assignment->id) }}" style="display:inline">
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
@endsection
