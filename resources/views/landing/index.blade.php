@extends('landing/layout/master')

@section('title', 'Home')

@section('content')
<!-- Header-->
<header class="bg-dark py-5">
    <div class="container px-5">
        <div class="row gx-5 align-items-center justify-content-center">
            <div class="col-lg-8 col-xl-7 col-xxl-6">
                <div class="my-5 text-center text-xl-start">
                    <h1 class="display-5 fw-bolder text-white mb-2">Pererenan Nengah Guest House</h1>
                    <p class="lead fw-normal text-white-50 mb-4">House guests should be regarded as perishables: Leave them out too long and the go bad!</p>
                    <div class="d-grid gap-1 d-sm-flex justify-content-sm-center justify-content-xl-start">
                        <a class="btn btn-primary btn-lg px-4 me-sm-3" href="{{ route('landing.booking') }}">Booking Now</a>
                        <a class="btn btn-outline-light btn-lg px-4" href="{{ route('landing.content') }}">Learn More</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-5 col-xxl-6 d-none d-xl-block text-center">
                <img class="img-fluid rounded-3 my-5" src="/asset-landing/img/img-cover-home.jpg" alt="..." />
            </div>
        </div>
    </div>
</header>

<!-- Features section-->
<section class="py-5" id="features">
    <div class="container px-5 my-5">
        <div class="row gx-5">
            <div class="col-lg-4 mb-5 mb-lg-0"><h2 class="fw-bolder mb-0">The services we provide at the guest house.</h2></div>
            <div class="col-lg-8">
                <div class="row gx-5 row-cols-1 row-cols-md-2">
                    <div class="col mb-5 h-100">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-wifi"></i></div>
                        <h2 class="h5 fw-bolder">Wi-Fi</h2>
                        <p class="mb-0">Wifi with high internet speed. Accessible in all rooms in the guest house</p>
                    </div>
                    <div class="col mb-5 h-100">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-snow2"></i></div>
                        <h2 class="h5 fw-bolder">Air Conditioner</h2>
                        <p class="mb-0">AC is available with a cool and comfortable room temperature for the stayers</p>
                    </div>
                    <div class="col mb-5 mb-md-0 h-100">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-moisture"></i></div>
                        <h2 class="h5 fw-bolder">Water Heater</h2>
                        <p class="mb-0">Provides hot water that can make the stay comfortable when they want to clean themselves.</p>
                    </div>
                    <div class="col h-100">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-water"></i></div>
                        <h2 class="h5 fw-bolder">Pool</h2>
                        <p class="mb-0">Large swimming pool to use to stay with the family.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Blog preview section-->
<section class="py-5">
    <div class="container px-5 my-5">
        
        <div class="row gx-5 justify-content-center">
            <div class="col-lg-8 col-xl-6">
                <div class="text-center">
                    <h2 class="fw-bolder">From our content</h2>
                    <p class="lead fw-normal text-muted mb-5">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eaque fugit ratione dicta mollitia. Officiis ad.</p>
                </div>
            </div>
        </div>
        <div class="row gx-5">
            @foreach ($data_konten as $konten)
                @php
                    $count_gambar = $data_gambar_konten->where('id_konten', $konten->id)->count();
                @endphp
                @if($count_gambar > 0)
                    @php
                        $rand_gambar = $data_gambar_konten->where('id_konten', $konten->id)->random(1)->first();
                    @endphp
                    <div class="col-lg-4 mb-5">
                        <div class="card h-100 shadow border-0">
                            <img class="card-img-top" src="{{ asset('storage/img/img-konten/'.$rand_gambar->link_gambar) }}" alt="..." />
                            <div class="card-body p-4">
                                <div class="badge bg-primary bg-gradient rounded-pill mb-2">{{ $konten->judul_konten }}</div>
                                <a class="text-decoration-none link-dark" href="#!">
                                    <h5 class="card-title mb-3">{{ $rand_gambar->nama_gambar }}</h5>
                                </a>
                                <p class="card-text mb-0">
                                    {{ $konten->deskripsi_konten }}
                                </p>
                            </div>
                            
                            <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
                                <div class="d-flex align-items-end justify-content-between">
                                    <a href="{{ route('landing.content') }}#content-{{ $konten->id }}" class="btn btn-outline-primary">View More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</section>
@endsection