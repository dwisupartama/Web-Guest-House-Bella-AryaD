@extends('landing/layout/master')

@section('title', 'Content')

@section('content')
    <!-- Page Content-->
    <section class="py-5">
        <div class="container px-5 my-5">
            <div class="text-center mb-5">
                <h1 class="fw-bolder">Content</h1>
                <p class="lead fw-normal text-muted mb-0">What's around Pererenan Nengah Guest House?</p>
            </div>
            <ul class="nav justify-content-center nav-pills mb-3 gap-3" id="pills-tab" role="tablist">
                @foreach ($data_konten as $konten)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link @if($loop->iteration == 1) active @endif" id="content-{{ $konten->id }}-tab" data-bs-toggle="pill" data-bs-target="#content-{{ $konten->id }}" type="button" role="tab" aria-controls="content-{{ $konten->id }}" aria-selected="false">
                            {{ $konten->judul_konten }}
                        </button>
                    </li>
                @endforeach
            </ul>
            <div class="tab-content" id="pills-tabContent">
                @foreach ($data_konten as $konten)
                    <div class="tab-pane fade @if($loop->iteration == 1) show active @endif" id="content-{{ $konten->id }}" role="tabpanel" aria-labelledby="content-{{ $konten->id }}-tab">
                        <h4 class="fw-bolder">Description :</h4>
                        <p class="mb-4">{{ $konten->deskripsi_konten}}</p>
                        <h4 class="fw-bolder mb-2">Galery :</h4>
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                            @php $jumlah_gambar = 0; @endphp
                            @foreach($data_gambar as $gambar)
                                @if($gambar->id_konten == $konten->id)
                                    <div class="col">
                                        <div class="card shadow-sm">
                                            <img class="card-img-top" src="{{ asset('storage/img/img-konten/'.$gambar->link_gambar) }}" alt="..." />
                                            <div class="card-body">
                                                <h5 class="card-title mb-3">{{ $gambar->nama_gambar }}</h5>
                                                <p class="card-text">{{ $gambar->keterangan }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    @php $jumlah_gambar++; @endphp
                                @endif
                            @endforeach

                            @if($jumlah_gambar < 1)
                                <p class="mb-4">Gallery not yet available</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script type="text/javascript">
        //grabs the hash tag from the url
        var hash = window.location.hash;

        //checks whether or not the hash tag is set
        if (hash != "") {
            //removes all active classes from tabs
            $('.nav .nav-item .nav-link').each(function() {
                $(this).removeClass('active');
            });
            $('.tab-content .tab-pane').each(function() {
                $(this).removeClass('show active');
            });

            //this will add the active class on the hashtagged value
            var link = "";
            $('.nav .nav-item .nav-link').each(function() {
                link = $(this).data("bs-target");
                if (link == hash) {
                    $(this).addClass('active');
                }
            });
            $('.tab-content .tab-pane').each(function() {
                link = $(this).attr('id');
                if ('#'+link == hash) {
                    $(this).addClass('show active');
                }
            });
        }
    </script>
@endsection