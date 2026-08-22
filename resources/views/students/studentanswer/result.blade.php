@extends('students.layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Answer results</h1>
    
    <!-- عرض رسالة النجاح -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mx-auto" role="alert" style="max-width: 600px; box-shadow: 0 4px 10px rgba(40, 167, 69, 0.3); transition: transform 0.3s ease-in-out;">
            <strong>Sent successfully</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- إذا لم تكن هناك نتائج بعد -->
    <div class="text-center mt-5">
        <p class="lead mb-4" >if you have completed the assignment, your results will appear from us</p>
        <a href="{{ route('students.studentanswer.index') }}" class="btn btn-primary btn-lg">Back to answer list</a>
    </div>
</div>
@endsection

<style>
    /* تحسين التنسيق العام للرسالة */
    .alert {
        font-size: 1.2rem;
        border-radius: 8px;
        text-align: center;
        margin-bottom: 2rem;
        padding: 20px;
        box-shadow: 0 4px 10px rgba(40, 167, 69, 0.3); /* ظل أخضر حول الرسالة */
        transition: transform 0.3s ease-in-out;
    }

    .alert-success {
        background-color: #d4edda;
        border-color: #c3e6cb;
        color: #155724;
    }

    /* تأثير التكبير عند مرور الماوس على الرسالة */
    .alert:hover {
        transform: scale(1.05);
    }

    /* تحسين التنسيق للعناوين */
    h1 {
        font-size: 2.5rem;
        font-weight: bold;
        color: #333;
        margin-bottom: 30px;
    }

    /* تحسين الزر */
    .btn-primary {
        padding: 15px 30px;
        font-size: 1.2rem;
        border-radius: 8px;
        transition: background-color 0.3s ease, transform 0.3s ease;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    /* تأثير الزر عند التمرير */
    .btn-primary:hover {
        background-color: #0056b3;
        transform: scale(1.05);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    }

    .container {
        max-width: 900px;
    }

    .text-center p {
        font-size: 1.2rem;
        margin-top: 20px;
        color: #555;
        font-weight: 300;
    }

    /* تحسين موقع زر الإغلاق */
    .btn-close {
        position: absolute;
        top: 10px;
        right: 10px;
    }
</style>
