<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="turbolinks-visit-control" content="reload">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
         
        .sidebar-header {
            background-color: #343a40; 
            color: white; 
            text-align: center; 
            font-size: 18px; 
            font-weight: bold; 
            padding: 16px; 
            border-bottom: 1px solid #ddd; 
        }
        .sidebar {
    width: 220px;
    height: calc(100vh - 64px); 
    position: fixed;
    top: 64px; 
    left: 0;
    background-color: #ffffff;
    border-right: 1px solid #ddd;
    z-index: 1000;  
    overflow-y: auto; 
   
}


        .sidebar a {
            display: block;
            color: #333;
            padding: 16px;
            text-decoration: none;
            font-size: 16px;
            border-bottom: 1px solid #ddd;
        }
        .sidebar a.active {
            background-color: #04AA6D;
            color: white;
            pointer-events: auto; 
        }
        .sidebar a:hover {
            background-color: #f5f5f5;
            color: #333;
          
        }

        .content {
       
        padding-left: 20%;
        padding-top: 70px;
        padding-right: 100px;
        position: relative; 
        z-index: 0; 
       width: 1100px;
        
    }

        .navbar {
            background-color: #343a40;
        }

        .navbar-brand {
            color: white;
            
        }
        nav {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%; 
    z-index: 10; 
    background-color: #ffffff; 
    border-bottom: 1px solid #ddd; 
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1); 
}


.main-content {
    margin-top: 64px; 
    padding: 20px; 
}


.content-area {
    margin-left: 240px; 
    padding: 20px;
}

.nav-link {
    display: inline-block;
    padding: 10px 20px;
    color: #333;
    text-decoration: none;
    font-size: 16px;
    font-weight: 500;
    transition: background-color 0.3s, color 0.3s;
}

.nav-link:hover {
    background-color: #f5f5f5;
    color: #04AA6D;
}

.active {
    background-color: #04AA6D;
    color: white;
}

    </style>
</head>
<body>
   
    <div class="min-h-screen bg-gray-100 flex">

         
        <div class="sidebar">
            
            <div class="sidebar-header">
                Admin Dashboard
            </div>
            <a href="{{ route('admin.student.index') }}" class="{{ request()->routeIs('admin.student.index') ? 'active' : '' }}">Students</a>


            <a href="{{ route('admin.teacher.index') }}" class="{{ request()->routeIs('admin.teacher.index') ? 'active' : '' }}">Teachers</a>
            <a href="{{ route('admin.course.index') }}" class="{{ request()->routeIs('admin.course.index') ? 'active' : '' }}">Courses</a>
            <a href="{{ route('admin.batches.index') }}" class="{{ request()->routeIs('admin.batches.index') ? 'active' : '' }}">Batches</a>
            <a href="{{ route('admin.enrollment.index') }}" class="{{ request()->routeIs('admin.enrollment.index') ? 'active' : '' }}">Enrollment</a>
            <a href="{{ route('admin.payments.index') }}"class="{{ request()->routeIs('admin.payments.index') ? 'active' : '' }}">Payments</a>
        </div>
        
        
        
        

        <div class="content">
            @include('admin.layouts.navigation')
            <main>
                @yield('content')
            </main>
        </div>
    </div>
    <script>
   document.querySelectorAll('.sidebar a').forEach(link => {
    link.addEventListener('click', function(e) {
        e.preventDefault();
        console.log(`Redirecting to: ${this.href}`);
        window.location.href = this.href;
    });
});


console.log("JavaScript is loaded");
    </script>
</body>

</html>
