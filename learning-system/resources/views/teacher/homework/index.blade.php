@extends('teacher.layouts.app')

@section('content')
<br/>
<div class="content">
    <div class="card-header">
        <h2>Assignment Management</h2>
    </div>
    <div class="card-body" style="background-color: white">
        <a href="{{ route('teacher.homework.create') }}" class="btn btn-success btn-sm"> Add New Assignment</a>
        <br/><br/>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>course</th>
                        <th>Deadline</th>
                        <th>Submissions</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if($homework->isEmpty())
                    <p>No assignments found.</p>
                @else 
                @foreach($homework as $assignment)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $assignment->title }}</td>
                        <td>{{ $assignment->courses->name  }}</td>

                        <td>{{ $assignment->deadline }}</td>
                   
                        <td>
                            <a href="{{ route('teacher.homework.show', $assignment->id) }}" class="btn btn-info btn-sm">
                                <i class="fa fa-eye"></i> View
                            </a>
                            <a href="{{ route('teacher.homework.edit', $assignment->id) }}" class="btn btn-primary btn-sm">
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
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
