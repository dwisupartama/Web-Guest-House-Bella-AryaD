@forelse($data_kamar as $kamar)
    <div class="col-lg-4 mb-5">
        <div class="card h-100 shadow border-0">
            <img class="card-img-top" src="{{ asset('storage/img/img-kamar/'.$kamar->gambar_kamar) }}" alt="..." />
            <div class="card-body p-4">
                <div class="badge bg-primary bg-gradient rounded-pill mb-2">{{ $kamar->tipeKamar->tipe_kamar }}</div>
                <a class="text-decoration-none link-dark" href="#!">
                    <h5 class="card-title mb-3">
                        {{ $kamar->tipeKamar->tipe_kamar }} <span class="fs-6 fw-normal">No. {{ $kamar->no_kamar }}</span>
                    </h5>
                </a>
                <p class="card-text mb-0">
                    {{ $kamar->deskripsi_singkat }}
                </p>
                <h5 class="card-title pricing-card-title mt-2">Rp. {{ number_format($kamar->harga_kamar, 0,',','.') }}<small class="text-muted fw-light">/night</small></h5>
            </div>
            <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
                <div class="d-flex align-items-end justify-content-between">
                    <a href="{{ route('landing.booking.room', [$kamar->id]) }}" class="btn btn-primary">Booking Now</a>
                </div>
            </div>
        </div>
    </div>
@empty
    <div class="col-lg-12">
        <div class="alert alert-primary text-center" role="alert">
            There are no rooms of that type available on that date 
        </div>
    </div>
@endforelse