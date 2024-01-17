<!doctype html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.87.0">
    <title>eMAS Homepage</title>

    <!-- Bootstrap core CSS -->

    <link href="/assets/css/app.css" rel="stylesheet">
    <link href="/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/loading.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    {{-- <link href="{!! url('assets/css/app.css') !!}" rel="stylesheet"> --}}
</head>
<body>
    
    @include('layouts.partials.navbar')

    <main class="container" style="margin-top: 3vh; margin-bottom:15vh">
        @yield('content')
    </main>

    @include('layouts.partials.footer')

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
    <script src="{!! url('assets/js/popper.min.js') !!}"></script>
    <script src="{!! url('assets/bootstrap/js/bootstrap.min.js') !!}"></script>
    @yield('scripts')
    <script>
      window.addEventListener("load", function () {
        // Hide the loading overlay when the page is fully loaded
        document.getElementById("loading-overlay").style.display = "none";
      });
    </script>
  </body>
</html>