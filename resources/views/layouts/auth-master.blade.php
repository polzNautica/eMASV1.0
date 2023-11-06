<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.87.0">
    <title>@yield('title')</title>

    <!-- Bootstrap core CSS -->
    <link href="{!! url('assets/css/app.css') !!}" rel="stylesheet">
    <link href="{!! url('assets/bootstrap/css/bootstrap.min.css') !!}" rel="stylesheet">
    <link href="{!! url('assets/css/loading.css') !!}" rel="stylesheet">

    {{-- <link href="{!! url('assets/css/signin.css') !!}" rel="stylesheet"> --}}

    <!-- Custom styles for this template -->
    {{-- <link href="signin.css" rel="stylesheet"> --}}
</head>
<body class="text-center">
    <!-- Loading overlay -->
    <div id="loading-overlay">
      <div class="loader"></div>
    </div>

    <main class="form-signin">
        <div>
          <div class="pt-5" style="background-color: rgba(201,35,75,1); box-shadow: 0px 0px 10px black;">
            <a href="/" style="text-decoration: none; color: white">
                <img src="/assets/images/emaslogo.png" alt="emaslogo" style="height:80px">
                <h1 class="h3 fw-normal">Welcome to eMAS</h1>
                <p class="pb-3">e-Medical Appoinment System</p>
            </a>
          </div>
            @yield('content')
        </div>
    </main>

    <!-- JavaScript to hide loading overlay when the page is fully loaded -->
    <script>
      window.addEventListener("load", function () {
        // Hide the loading overlay when the page is fully loaded
        document.getElementById("loading-overlay").style.display = "none";
      });
    </script>
</body>
</html>
