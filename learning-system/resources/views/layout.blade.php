<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Teachers Management System</title>

    <style>
        /* The side navigation menu */
        .sidebar {
          margin-top: 20px;
          padding: 0;
          width: 200px;
          background-color: #f1f1f1;
          height: 100%;
          position: fixed;/*العنصر يخليه ثابث حتى لوعملت سكرول*/
          overflow: auto;/*يعرض المحتوى اذا تجاوز حجم العنصر*/
          
        }

        /* Sidebar links */
        .sidebar a {
          display: block;
          color: black;
          padding: 16px;
          text-decoration: none;
        }

        /* Active/current link */
        .sidebar a.active {
          background-color: #04AA6D;
          color: white;
        }

        /* Links on mouse-over */
        .sidebar a:hover {
          background-color: #555;
          color: white;
        }

        /* Adjust content margin to avoid overlapping with sidebar */
        .content {
          margin-left: 220px;
          padding: 20px;
        }
    </style>
</head>
<body>
  <!-- Navbar في الأعلى -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#"><h2>Teachers Management Project</h2></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </nav>

  <div class="container-fluid"> <!--     يدعم عرض الشاشة كامل ويكون رسبونسف-->
    <div class="row">
        <!-- الشريط الجانبي -->
        <div class="col-md-3 sidebar">
            <a class="active" href="#home">Home</a>
            <a href="{{url('/student')}}">Students</a>
            <a href="{{url('/teacher')}}">Teacher</a>
            <a href="{{url('/course')}}">Courses</a>
            <a href="{{url('/batches')}}">Batches</a>
            <a href="{{url('/enrollment')}}">Enrollment</a>
            <a href="{{url('/payments')}}">Payment</a>
        </div>

        <!-- محتوى الصفحة -->
        <div class="col-md-9 content">
            @yield('content')
        </div>
    </div>
  </div>
</body>
</html>
