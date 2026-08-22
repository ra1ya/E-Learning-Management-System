@extends('admin.layouts.app')

@section('content')
<br/>
<br/>
<div class="content">
    <div class="card-header">
        <h2>teachers Appliction</h2>
    </div>
    <div class="card-body" style="background-color: white" >
        <a href="{{ route('admin.teacher.create') }}" class="btn btn-success btn-sm"> Add New</a>
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
                @foreach($teachers as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->address }}</td>
                        <td>{{ $item->mobile }}</td>
                        <td>{{ $item->email }}</td>

                        <td>
                            <a href="{{ url('admin/teacher/' . $item->id) }}" title="View Student"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                            <a href="{{ url('admin/teacher/' . $item->id . '/edit') }}" title="Edit Student"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                            <form method="POST" action="{{ url('admin/teacher/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
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

@endsection
