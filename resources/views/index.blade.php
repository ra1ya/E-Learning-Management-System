<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Elegant Transparent Background</title>
    <style>
        body {
            background-image: url('logo/BN.png'); /* مسار صورة الخلفية */
            background-size: cover; /* لجعل الصورة تغطي الشاشة */
            background-position: center; /* تموضع الصورة في المنتصف */
            background-repeat: no-repeat; /* منع تكرار الصورة */
            background-attachment: fixed; /* تثبيت الصورة أثناء التمرير */
            background-color: rgba(255, 255, 255, 0.8); /* لون أبيض مع شفافية */
            background-blend-mode: overlay; /* دمج اللون الشفاف مع الصورة */
            font-family: 'Roboto', sans-serif; /* الخط المستخدم */
            color: #444; /* اللون الأساسي للنص */
            line-height: 1.6; /* تحسين التباعد بين الأسطر */
            padding: 20px; /* إضافة مسافة من الحواف */
            text-align: center; /* توسيط النصوص */
        }

        nav {
            margin-top: 100px; /* المسافة من الأعلى */
            display: flex;
            flex-direction: column; /* ترتيب الروابط تحت بعض */
            align-items: center;
        }

        a {
            display: block;
            width: 250px;
            margin: 15px 0; /* المسافة بين الروابط */
            padding: 12px 20px;
            text-decoration: none;
            background-color: rgba(255, 255, 255, 0.9); /* خلفية بيضاء شفافة */
            color: #2d2d2d; /* لون النص */
            font-size: 18px;
            border-radius: 8px; /* حواف دائرية */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* إضافة ظل بسيط */
            transition: all 0.3s ease-in-out; /* تأثيرات سلسة عند التمرير */
        }

        a:hover {
            background-color: rgba(42, 0, 253, 0.974); /* تغيير اللون عند التمرير */
            color: #fff; /* تغيير لون النص عند التمرير */
            transform: translateY(-5px); /* تحريك الرابط قليلاً عند التمرير */
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2); /* تعزيز الظل */
        }

        @media (max-width: 768px) {
            a {
                width: 90%; /* لتوسيع الروابط على الشاشات الصغيرة */
            }
        }
    </style>
</head>
<body>
    @if (Route::has('login'))
        <nav>
            @auth('web')
                <a href="{{ url('/dashboard') }}">
                    Dashboard
                </a>
            @else
            
            @endauth

            @auth('admin')
                <a href="{{ url('/admin/dashboard') }}">
                    Admin Dashboard
                </a>
            @else
                <a href="{{ route('admin.login') }}">
                    Admin Log in
                </a>

                @if (Route::has('admin.register') && \App\Models\Admin::count() == 0)
                    <a href="{{ route('admin.register') }}">
                        Admin Register
                    </a>
                @endif
            @endauth

            @auth('teacher')
                <a href="{{ url('/teacher/dashboard') }}">
                    Teacher Dashboard
                </a>
            @else
                <a href="{{ route('teacher.login') }}">
                    Teacher Log in
                </a>

                @if (Route::has('teacher.register'))
                    <a href="{{ route('teacher.register') }}">
                        Teacher Register
                    </a>
                @endif
            @endauth

            @if (Route::has('students.login'))
                @auth('students')
                    <a href="{{ url('/students/dashboard') }}">
                        Students Dashboard
                    </a>
                @else
                    <a href="{{ route('students.login') }}">
                        Students Log in
                    </a>

                    @if (Route::has('students.register'))
                        <a href="{{ route('students.register') }}">
                            Students Register
                        </a>
                    @endif
                @endauth
            @endif
        </nav>
    @endif
</body>
</html>
