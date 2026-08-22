@extends('admin.layouts.app')

@section('content')
<div class="card">
    <div class="card-header"><h2>Payments</h2></div>
    <div class="card-body">
        <a href="{{ route('admin.payments.create') }}" class="btn btn-success btn-sm">Add New</a>
        <br><br>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th><th>Enrollment No</th><th>Paid Date</th><th>Amount</th><th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($payments as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->enrollment?->enroll_no ?? 'N/A' }}</td>
                        <td>{{ $item->paid_date }}</td>
                        <td>{{ $item->amount }}</td>
                        <td>
                            <a href="{{ route('admin.payments.show', $item) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('admin.payments.edit', $item) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form method="POST" action="{{ route('admin.payments.destroy', $item) }}" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Confirm delete?')">Delete</button>
                            </form>
                            <a href="{{ route('admin.report.payment', $item->id) }}" class="btn btn-success btn-sm">Print</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
