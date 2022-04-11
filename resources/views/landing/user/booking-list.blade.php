@extends('landing/layout/master')

@section('title', 'Booking List')

@section('content')
@if (\Session::has('success'))
    <script type="text/javascript">
    Swal.fire({
        icon: "success",
        title: "Successful",
        text: "{!! \Session::get('success') !!}",
        confirmButtonColor: '#3085d6',
    });
    </script>
@endif

<!-- Modal -->
<div class="modal fade" id="modal-booking-details" tabindex="-1" aria-labelledby="model-booking-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bolder" id="exampleModalLabel">Booking Detail</h5>
                <button wire:click type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="body-modal-booking-details">

            </div>
        </div>
    </div>
</div>

<div class="container px-5 mt-5 mb-5">
    <div class="row">
        <div class="col-lg-3">
            @php
                if($jumlah_reservasi != 0){
                    $complete = ($jumlah_complete / $jumlah_reservasi) * 100;
                    $on_progress = ($jumlah_on_progress / $jumlah_reservasi) * 100;
                    $waiting_payment = ($jumlah_waiting_payment / $jumlah_reservasi) * 100;
                }else{
                    $complete = 0;
                    $on_progress = 0;
                    $waiting_payment = 0;
                }
            @endphp
            <div class="card border-0 bg-success bg-opacity-10 mb-3">
                <div class="card-body">
                    <div class="fs-6 fw-normal text-success">Complete</div>
                    <p class="fs-3 fw-bold text-success">{{ $jumlah_complete }}<span class="fs-5"> Order</span></p>
                    <div class="progress bg-secondary bg-opacity-25">
                        <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="{{ $complete }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $complete }}%"></div>
                    </div>
                </div>
            </div>
            <div class="card border-0 bg-primary bg-opacity-10 mb-3">
                <div class="card-body">
                    <div class="fs-6 fw-normal text-primary">On Progress</div>
                    <p class="fs-3 fw-bold text-primary">{{ $jumlah_on_progress }}<span class="fs-5"> Order</span></p>
                    <div class="progress bg-secondary bg-opacity-25">
                        <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="{{ $on_progress }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $on_progress }}%"></div>
                    </div>
                </div>
            </div>
            <div class="card border-0 bg-warning bg-opacity-10">
                <div class="card-body">
                    <div class="fs-6 fw-normal text-warning">Waiting for Payment</div>
                    <p class="fs-3 fw-bold text-warning">{{ $jumlah_waiting_payment }}<span class="fs-5"> Order</span></p>
                    <div class="progress bg-secondary bg-opacity-25">
                        <div class="progress-bar bg-warning progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="{{ $waiting_payment }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $waiting_payment }}%"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="mb-3">
                <h2>Booking List</h2>
                <p>Your booking list at Pererenan Nengah Guest House</p>
            </div>
            @forelse ($data_reservasi as $reservasi)
                <div class="card bg-secondary mb-3" style="--bs-bg-opacity: .08;">
                    <div class="card-body py-2 pb-3">
                        <div class="row">
                            <div class="col-lg-8">
                                <div>
                                    <small class="fw-normal fw-bolder text-secondary">
                                        {{ $reservasi->no_reservasi }}
                                    </small>
                                </div>
                                <small class="fw-lighter text-muted">
                                    Date Order : {{ DateHelpers::formatDateInggris($reservasi->tgl_pemesanan) }}
                                </small>
                                &nbsp;
                                <span class="badge text-primary border border-primary">
                                    <i class="bi bi-box-arrow-in-right"></i>
                                    &nbsp;
                                    {{ DateHelpers::formatDateInggris($reservasi->tgl_book_check_in) }}
                                </span>
                                &nbsp;
                                <span class="badge text-primary border border-primary">
                                    <i class="bi bi-box-arrow-left"></i>
                                    &nbsp;
                                    {{ DateHelpers::formatDateInggris($reservasi->tgl_book_check_out) }}
                                </span>
                            </div>
                            <div class="col-lg-4 text-end align-middle">
                                @if ($reservasi->status_reservasi == "Menunggu Pembayaran")
                                    <span class="badge bg-warning text-dark">Waiting Payment</span>
                                @elseif($reservasi->status_reservasi == "Siap di Check-in")
                                    <span class="badge bg-primary">Ready to Check-in</span>
                                @elseif($reservasi->status_reservasi == "Sudah Check-in")
                                    <span class="badge bg-success">Already Checked-in</span>
                                @elseif($reservasi->status_reservasi == "Sudah Check-out")
                                    <span class="badge bg-success">Already Checked-out</span>
                                @else
                                    <span class="badge bg-danger">Canceled</span>
                                @endif
                            </div>
                        </div>
                        <hr class="dropdown-divider" />
                        <div class="row">
                            @php
                                $room_first = $data_detail_reservasi->where('id_reservasi', $reservasi->id)->first();
                            @endphp
                            <div class="col-lg-12">
                                <div class="image-cart-item" style="background-image: url('{{ asset('storage/img/img-kamar/'.$room_first->kamar->gambar_kamar) }}')"></div>
                                <div class="content-cart-item">
                                    <div class="fw-normal">
                                        {{ $room_first->kamar->tipeKamar->tipe_kamar }} Room <span class="fw-bolder" style="font-size: 13px;">No. {{ $room_first->kamar->no_kamar }}</span>
                                    </div>
                                    <small>
                                    <span class="text-muted">Adults: </span> {{ $room_first->jumlah_dewasa }} &nbsp;
                                    <span class="text-muted">Children: </span> {{ $room_first->jumlah_anak }}
                                    </small>
                                </div>
                            </div>
                            <div class = "col-lg-12 mt-2 mb-2">
                                <span class="badge rounded-pill bg-secondary">
                                    @php
                                        $jumlah_kamar = $data_detail_reservasi->where('id_reservasi', $reservasi->id)->count();
                                    @endphp
                                    @if ($jumlah_kamar > 1)
                                        + {{ $jumlah_kamar - 1 }} Other Room
                                    @else
                                        Only 1 Room
                                    @endif
                                </span>
                            </div>
                        </div>
                        <hr class="dropdown-divider" />
                        <div class="row">
                            <div class="col-lg-6">
                                <small class="text-muted">Total Payment : </small>
                                <div class="fs-5 fw-bolder">
                                    Rp . {{ number_format($reservasi->total_pembayaran,0,',','.') }}
                                </div>
                            </div>
                            <div class="col-lg-6 text-end">
                                @if ($reservasi->status_reservasi == "Menunggu Pembayaran")
                                    <a href="#" class="btn btn-danger btn-batalkan" data-id="{{ $reservasi->id }}"><i class="bi bi-x-circle"></i>&nbsp;&nbsp;Cancle</a>                                    
                                @endif

                                <button type="button" class="btn btn-success btn-get-booking" data-id="{{ $reservasi->id }}" {{-- data-bs-toggle="modal" data-bs-target="#modal-booking-details" --}}>
                                    <i class="bi bi-journal-text" id="icon-button-booking-{{ $reservasi->id }}"></i>
                                    <div class="d-none spinner-border spinner-border-sm text-light" role="status" id="loading-booking-{{ $reservasi->id }}">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    &nbsp;Booking Detail
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-secondary" role="alert">
                    No bookings have been made yet
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection

@section('script')
    <script type="text/javascript">
        $(function(){
            $(".btn-get-booking").click(function(){
                let id = $(this).data("id");
                $.ajax({
                    type: 'GET',
                    url: "/user/booking-detail/"+id,
                    beforeSend: function(){
                        $("#loading-booking-"+id).removeClass("d-none");
                        $("#icon-button-booking-"+id).addClass("d-none");
                    },
                    success: function(data){
                        $("#loading-booking-"+id).addClass("d-none");
                        $("#icon-button-booking-"+id).removeClass("d-none");
                        $("#body-modal-booking-details").html(data);
                        $("#modal-booking-details").modal('show');
                    }
                });
            });

            $(".btn-batalkan").click(function(e){
                e.preventDefault();
                let data_id = $(this).data('id');
                
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Booking will be canceled permanently!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Continue!',
                    cancelButtonText: 'Cancle'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "/user/booking-cancle/"+data_id;
                    }
                });
            });
        });
    </script>
@endsection