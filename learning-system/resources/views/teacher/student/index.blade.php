@extends('teacher.layouts.app')

@section('content')
<br/>
<br/>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

<div class="content">
    <div class="card-header">
        <h2>Student Appliction</h2>
    </div>
    <div class="card-body" style="background-color: white" >
        <form method="GET" action="{{ route('teacher.student.index') }}" class="form-inline mb-3">
            <input type="text" name="search" class="form-control mr-2" placeholder="Search Students" value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
        <a href="{{ route('teacher.student.create') }}" class="btn btn-success btn-sm"> Add New</a>
        <br/>
        <br/>
        <div class="table-responsive">
            <table class="table" >
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($students as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->address }}</td>
                        <td>{{ $item->mobile }}</td>
                        <td>{{ $item->email }}</td>
                        
                        <td>
                            <a href="{{ url('teacher/student/' . $item->id) }}" title="View Student"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                            <a href="{{ url('teacher/student/' . $item->id . '/edit') }}" title="Edit Student"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                            <form method="POST" action="{{ url('teacher/student/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                {{ method_field('DELETE') }} <!--يخير لارافل ان الطلب يجب ان يكون من نوع الحذف-->
                                {{ csrf_field() }}  <!--يقوم بمنع الهجمات-->
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



@endsection
