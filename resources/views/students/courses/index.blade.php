@extends('students.layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

<style>
    .table th, .table td {
        text-align: center; 
        vertical-align: middle; 
    }

    .btn {
        margin: 5px 0; 
    }

    .table th:last-child {
        padding-right: 20px; 
    }

    .btn-view {
        display: inline-block;
        margin-top: 5px; 
    }
</style>

<div class="card">
    <div class="card-header">
        <h2>Course Application</h2>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ url('students/course') }}" class="form-inline mb-3">
            <input type="text" name="search" class="form-control mr-2" placeholder="Search Courses" value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>

        <br />
        <br />
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Syllabus</th>
                        <th>Duration</th>
                        <th>Actions</th>
                        
                        
                    </tr>
                </thead>
                <tbody>
                @foreach($courses as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->syllabus }}</td>
                        <td>{{ $item->duration() }}</td>
                        
                        <td>
                            <a href="{{ url('students/courses/' . $item->id) }}" title="View Course">
                                <button class="btn btn-info btn-sm btn-view">
                                    <i class="fa fa-eye" aria-hidden="true"></i> View
                                </button>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
