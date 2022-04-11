<div class="row">
    <div class="col-lg-8">
        <div class="row mb-2">
            <div class="col-lg-6">
                Reservation Status
            </div>
            <div class="col-lg-6 text-end">
                @if ($data_reservasi->status_reservasi == "Menunggu Pembayaran")
                    <span class="badge bg-warning text-dark">Waiting Payment</span>
                @elseif($data_reservasi->status_reservasi == "Siap di Check-in")
                    <span class="badge bg-primary">Ready to Check-in</span>
                @elseif($data_reservasi->status_reservasi == "Sudah Check-in")
                    <span class="badge bg-success">Already Checked-in</span>
                @elseif($data_reservasi->status_reservasi == "Sudah Check-out")
                    <span class="badge bg-success">Already Checked-out</span>
                @else
                    <span class="badge bg-danger">Canceled</span>
                @endif
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-lg-6">
                No. Reservation
            </div>
            <div class="col-lg-6 text-end text-primary fw-bolder">
                {{ $data_reservasi->no_reservasi }}
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-lg-6">
                Ordered Date
            </div>
            <div class="col-lg-6 text-end">
                {{ DateHelpers::formatDateInggrisWithTime($data_reservasi->tgl_pemesanan) }} WITA
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-lg-6">
                Customer Name
            </div>
            <div class="col-lg-6 text-end">
                {{ $data_reservasi->nama_user }}
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-lg-6">
                Email Address
            </div>
            <div class="col-lg-6 text-end">
                {{ $data_reservasi->email_user }}
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-lg-6">
                Country of Region
            </div>
            <div class="col-lg-6 text-end">
                {{ $data_reservasi->asal_negara_user }}
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-lg-6">
                Phone Number
            </div>
            <div class="col-lg-6 text-end">
                {{ $data_reservasi->no_telp_user }}
            </div>
        </div>
        @foreach ($data_detail_reservasi as $detail_reservasi)
            <div class="card bg-secondary mb-2" style="--bs-bg-opacity: .08;">
                <div class="card-body p-2 pt-1">
                    <div class="row">
                        <div class="col-lg-6">
                            <small>Room Status</small>
                        </div>
                        <div class="col-lg-6 text-end">
                            @if ($detail_reservasi->status_reservasi_kamar == "Menunggu Pembayaran")
                                <span class="badge bg-warning text-dark">Waiting Payment</span>
                            @elseif($detail_reservasi->status_reservasi_kamar == "Siap di Check-in")
                                <span class="badge bg-primary">Ready to Check-in</span>
                            @elseif($detail_reservasi->status_reservasi_kamar == "Sudah Check-in")
                                <span class="badge bg-success">Already Checked-in</span>
                            @elseif($detail_reservasi->status_reservasi_kamar == "Sudah Check-out")
                                <span class="badge bg-success">Already Checked-out</span>
                            @else
                                <span class="badge bg-danger">Canceled</span>
                            @endif
                        </div>
                    </div>
                    <hr class="dropdown-divider">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="col-lg-12">
                                <div class="image-cart-item"
                                    style="background-image: url('{{ asset('storage/img/img-kamar/'.$detail_reservasi->kamar->gambar_kamar) }}')">
                                </div>
                                <div class="content-cart-item">
                                    <div class="fw-normal">
                                        {{ $detail_reservasi->kamar->tipeKamar->tipe_kamar }} Room <span class="fw-bolder" style="font-size: 13px;">No. {{ $detail_reservasi->kamar->no_kamar }}</span>
                                    </div>
                                    <small>
                                        <span class="text-muted">Adults: </span> {{ $detail_reservasi->jumlah_dewasa }} &nbsp;
                                        <span class="text-muted">Children: </span> {{ $detail_reservasi->jumlah_anak }}
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 text-end">
                            <div>
                                Total Price
                            </div>
                            <div>
                                <small class="text-muted">{{ $data_reservasi->durasi_reservasi }} x Rp . {{ number_format($detail_reservasi->harga_kamar,0,',','.') }} :</small>
                                <span class="fw-bolder">Rp . {{ number_format($detail_reservasi->total_harga_kamar,0,',','.') }}</span>
                            </div>
                        </div>
                    </div>
                    <hr class="dropdown-divider">
                    <div class="row">
                        <div class="col-lg-3">
                            <small>Check-in Date</small>
                        </div>
                        @if(!$detail_reservasi->datetime_check_in)
                            <div class="col-lg-9 text-end">
                                <small>
                                    Haven't checked in yet
                                </small>
                            </div>
                        @else
                            <div class="col-lg-9 text-end fw-bolder text-success">
                                <small>
                                    ({{ $detail_reservasi->adminCheckIn->nama_admin }}) {{ DateHelpers::formatDateInggrisWithTime($detail_reservasi->datetime_check_in) }} WITA
                                </small>
                            </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <small>Check-out Date</small>
                        </div>
                        @if(!$detail_reservasi->datetime_check_out)
                            <div class="col-lg-9 text-end">
                                <small>
                                    Haven't checked out yet
                                </small>
                            </div>
                        @else
                            <div class="col-lg-9 text-end fw-bolder text-success">
                                <small>
                                    ({{ $detail_reservasi->adminCheckOut->nama_admin }}) {{ DateHelpers::formatDateInggrisWithTime($detail_reservasi->datetime_check_out) }} WITA
                                </small>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
        <div class="fw-bolder mt-3 mb-2">
            Payment Details
        </div>
        @foreach ($data_detail_reservasi as $detail_reservasi)
            <div class="row mb-1">
                <div class="col-lg-6">
                    Price {{ $detail_reservasi->kamar->tipeKamar->tipe_kamar }} Room No. {{ $detail_reservasi->kamar->no_kamar }}
                </div>
                <div class="col-lg-6 text-end">
                    Rp . {{ number_format($detail_reservasi->total_harga_kamar,0,',','.') }}
                </div>
            </div>
        @endforeach
        <hr class="dropdown-divider">
        <div class="row mb-1">
            <div class="col-lg-6 fw-bolder">
                Total Payment
            </div>
            <div class="col-lg-6 text-end fw-bolder">
                Rp . {{ number_format($data_reservasi->total_pembayaran,0,',','.') }}
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card border-0 bg-primary bg-opacity-10 mb-3">
            <div class="card-body">
                <div class="fs-6 fw-normal text-primary">Check-in Date</div>
                <p class="fs-5 fw-bold mb-0 text-primary">
                    {{ DateHelpers::formatDateInggris($data_reservasi->tgl_book_check_in) }}</p>
            </div>
        </div>
        <div class="card border-0 bg-primary bg-opacity-10 mb-3">
            <div class="card-body">
                <div class="fs-6 fw-normal text-primary">Duration</div>
                <p class="fs-5 fw-bold mb-0 text-primary">{{ $data_reservasi->durasi_reservasi }} Night</p>
            </div>
        </div>
        <div class="card border-0 bg-primary bg-opacity-10 mb-3">
            <div class="card-body">
                <div class="fs-6 fw-normal text-primary">Check-out Date</div>
                <p class="fs-5 fw-bold mb-0 text-primary">
                    {{ DateHelpers::formatDateInggris($data_reservasi->tgl_book_check_out) }}</p>
            </div>
        </div>
    </div>
</div>