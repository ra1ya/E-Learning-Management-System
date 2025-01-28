<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة تحكم المدير</title>
</head>
<body>
    <h1>مرحبًا، {{ auth()->user()->name }}</h1>
    <h2>طلبات التسجيل</h2>
    <table border="1">
        <thead>
            <tr>
                <th>#</th>
                <th>الاسم</th>
                <th>البريد الإلكتروني</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($registrations as $registration)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $registration->name }}</td>
                    <td>{{ $registration->email }}</td>
                    <td>
                        <form method="POST" action="/admin/approve/{{ $registration->id }}">
                            @csrf
                            <button type="submit">موافقة</button>
                        </form>
                        <form method="POST" action="/admin/reject/{{ $registration->id }}">
                            @csrf
                            <button type="submit">رفض</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <form method="POST" action="/logout">
        @csrf
        <button type="submit">تسجيل خروج</button>
    </form>
</body>
</html>
