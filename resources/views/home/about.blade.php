@extends('layouts.app-master')

@section('activeAbout')
active
@endsection

@section('content')
@include('layouts.partials.messages')
    <div class="bg-light p-5 rounded">
        <h1 class="mb-3">About Us</h1>
        <div class="d-flex mb-5" style="flex-direction: column">
            <div class="d-flex mobilerowtocol" style="flex-direction: row"> 
                <img src="/assets/images/pku.jpg" alt="pku_front" style="max-width: 45vw" class="mb-2 mobilewidth100">
                <p class="lead px-md-5">Providing Medical and Dental services to customers to
                     ensure their health status is in good condition in accordance with the 
                     medical standards used, towards improving the quality of life, concentration 
                     time and productivity of learning, research and services.</p>
            </div>
        </div>
        <div class="d-flex" style="flex-direction: column">
            <div class="d-flex" style="flex-direction: row; align-items:center">
                <i class="fa-solid fa-location-dot px-2"></i>Jalan Universiti 1, Putra Square, 43400 Serdang, Selangor
            </div>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3984.381274731036!2d101.70578587452903!3d2.9915198541023185!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cdca7f75b4e2fb%3A0xd9a8f0e558e24e24!2sPusat%20Kesihatan%20Universiti%2C%20UPM%20(PKU%20UPM)!5e0!3m2!1sen!2smy!4v1702557990089!5m2!1sen!2smy" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        
        
        {{-- @auth
        <h1>Dashboard</h1>
        <h5>Welcome, {{ Auth::user()->username }}!</h5>
        <p class="lead">Only authenticated users can access this section.</p>
        @endauth

        @guest
        <h1>Homepage</h1>
        <p class="lead">Your viewing the home page. Please login to view the restricted data.</p>
        @endguest --}}
    </div>
@endsection