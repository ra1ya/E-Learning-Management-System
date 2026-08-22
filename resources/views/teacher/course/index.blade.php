@extends('teacher.layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

                <div class="card">
                    <div class="card-header">
                        <h2>Course Appliction</h2>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ url('teacher/course') }}" class="form-inline mb-3">
                            <input type="text" name="search" class="form-control mr-2" placeholder="Search Courses" value="{{ request('search') }}">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </form> 
                        <a href="{{ url('teacher/course/export') }}" class="btn btn-secondary btn-sm">
                            <i class="fa fa-download" aria-hidden="true"></i> Export to Excel
                        </a> 
                        <a href="{{ url('teacher/course/create') }}" class="btn btn-success btn-sm" title="Add New Course">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>
                       
                        
                        <br/>
                        <br/>
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
                                            <a href="{{ url('teacher/course/' . $item->id) }}" title="View Course"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('teacher/course/' . $item->id . '/edit') }}" title="Edit Course"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
 
                                            <form method="POST" action="{{ url('teacher/course' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Student" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
 
                    </div>
        
                </div>
                <style>
                       
                .content {
                    
                  padding-left: 350px;
                  padding-top: 240px;
                  
                 
                  position: relative; 
                  z-index: 0; 
                 width: 1300px;
                  
              }
              </style>  
             
          
@endsection