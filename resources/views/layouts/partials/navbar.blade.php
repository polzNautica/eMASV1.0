<header class="p-3 text-white" style="background-color:rgba(201,35,75,1); box-shadow: 0px 0px 10px black;">
  <div class="container">
    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start col-12">
      <div class="col-lg-2 d-none d-lg-block">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
          <img src="/assets/images/emaslogo.png" alt="emaslogo" style="max-height:30px; margin-right:10px">
          <h1>eMAS</h1>
        </a>
      </div>
  <nav class="navbar navbar-expand-lg col">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
        <li class="nav-item @yield('activeHome')"><a href="/" class="nav-link px-2 text-white">Home</a></li>
        @auth
          <li class="nav-item @yield('activeNewAppointment')"><a href="/" class="nav-link px-2 text-white">Make an Appointment</a></li>
          <li class="nav-item @yield('activeUserAppointment')"><a href="/" class="nav-link px-2 text-white">Your Appointment</a></li>
        @endauth

        @guest
        <li class="nav-item @yield('activeFeature')"><a href="#" class="nav-link px-2 text-white">Features</a></li>
        <li class="nav-item @yield('activeContact')"><a href="#" class="nav-link px-2 text-white">Contact US</a></li>
        <li class="nav-item @yield('activeFaq')"><a href="#" class="nav-link px-2 text-white">FAQs</a></li>
        <li class="nav-item @yield('activeAbout')"><a href="about" class="nav-link px-2 text-white">About Us</a></li>
        @endguest
      </ul>
    </div>
  </nav>
      

      {{-- <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
        <input type="search" class="form-control form-control-dark" placeholder="Search..." aria-label="Search">
      </form> --}}

      @auth
        {{auth()->user()->name}}
        <div class="dropdown text-end mobileusername">
          <button class="btn btn-outline-light dropdown-toggle"
          type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
            {{Auth::user()->username}}
          </button>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><a class="dropdown-item" href="#">Some Action</a></li>
            <li><a class="dropdown-item" href="#">Another Action</a></li>
            <li><a class="dropdown-item" href="{{ route('logout.perform') }}">Logout</a></li>
          </ul>
        </div>
        {{-- <div class="text-end">
          <a href="{{ route('logout.perform') }}" class="btn btn-outline-light me-2">Logout</a>
        </div> --}}
      @endauth

      @guest
        <div class="text-end mobileusername">
          <a href="{{ route('login.perform') }}" class="btn btn-outline-light me-2">Login</a>
          <a href="{{ route('register.perform') }}" class="btn btn-warning">Sign-up</a>
        </div>
      @endguest
    </div>
  </div>
</header>