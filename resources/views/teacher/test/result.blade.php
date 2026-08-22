@extends('teacher.layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h2 class="text-center mb-0">نتائج الإجابات</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 text-center">
                    <p class="display-4 font-weight-bold text-success">
                        {{ $earnedMarks }} / {{ $totalMarks }}
                    </p>
                    <p class="lead">
                        مجموع الدرجات التي حصلت عليها مقارنة بالدرجة الكلية.
                    </p>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-12 text-center">
                    <a href="{{ route('teacher.test.index') }}" class="btn btn-outline-primary btn-lg">
                        العودة إلى قائمة الواجبات
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
