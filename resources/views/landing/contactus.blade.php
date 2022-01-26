@extends('landing/layout/master')

@section('title', 'Contact Us')

@section('content')
    <!-- Page content-->
    <section class="py-5">
        <div class="container px-5">
            <!-- Contact form-->
            <div class="rounded-3">
                <div class="text-center mb-5">
                    <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-telephone"></i></div>
                    <h1 class="fw-bolder">Contact Us</h1>
                    <p class="lead fw-normal text-muted mb-0">You can contact us at...</p>
                </div>
            </div>
            <!--Google map-->
            <div id="map-container-google-1" class="z-depth-1-half map-container" style="height: 500px">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3944.4353208178554!2d115.12515451429502!3d-8.650081390377222!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd23870ef2d6839%3A0xff9391d4f5df98cc!2sPererenan%20Nengah%20guest%20house!5e0!3m2!1sid!2sid!4v1643020281683!5m2!1sid!2sid" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
            
            <!--Google Maps-->

            <!-- Contact cards-->
            <div class="row gx-5 row-cols-2 row-cols-lg-3 py-5">
                <div class="col">
                    <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-geo-alt"></i></div>
                    <div class="h5 mb-2">Our Address</div>
                    <p class="text-muted mb-0">Jl. Munduk Kedungu No.30, Pererenan, Kec. Mengwi, Kabupaten Badung, Bali 80351.</p>
                </div>
                <div class="col">
                    <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-envelope"></i></div>
                    <div class="h5">Email Address</div>
                    <p class="text-muted mb-0">nengahguesthouse@gmail.com</p>
                </div>
                <div class="col">
                    <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-telephone"></i></div>
                    <div class="h5">Phone Number</div>
                    <p class="text-muted mb-0">+62 81 337 273 300</p>
                </div>
            </div>
        </div>
    </section>
@endsection