@extends('admin/layout/master')

@section('title', 'Detail Reservasi')

@section('content')
<div class="alert alert-primary mb-4 col-lg-9" role="alert">
    Ini merupakan halaman untuk melakukan proses pada data reservasi yang dipesan oleh customer.
</div>

@if (\Session::has('success'))
<script type="text/javascript">
Swal.fire({
    icon: "success",
    title: "Berhasil",
    text: "{!! \Session::get('success') !!}",
    confirmButtonColor: '#3085d6',
});
</script>
@endif

<div class="card col-lg-9 mb-3">
    <div class="card-header">
        <div class="w-auto float-start fs-6">
            <i class="fas fa-table"></i>
            Detail Reservasi
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-2">
            <div class="col-lg-6">
                Status Reservasi
            </div>
            <div class="col-lg-6 text-end">
                @if ($data_reservasi->status_reservasi == "Menunggu Pembayaran")
                    <span class="badge bg-warning text-dark">{{ $data_reservasi->status_reservasi }}</span>
                @elseif($data_reservasi->status_reservasi == "Siap di Check-in")
                    <span class="badge bg-primary">{{ $data_reservasi->status_reservasi }}</span>
                @elseif($data_reservasi->status_reservasi == "Sudah Check-in")
                    <span class="badge bg-success">{{ $data_reservasi->status_reservasi }}</span>
                @elseif($data_reservasi->status_reservasi == "Sudah Check-out")
                    <span class="badge bg-success">{{ $data_reservasi->status_reservasi }}</span>
                @else
                    <span class="badge bg-danger">{{ $data_reservasi->status_reservasi }}</span>
                @endif
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-lg-6">
                No. Reservasi
            </div>
            <div class="col-lg-6 text-end text-primary fw-bolder">
                {{ $data_reservasi->no_reservasi }}
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-lg-6">
                Tanggal Pemesanan
            </div>
            <div class="col-lg-6 text-end">
                {{ DateHelpers::formatDateLocalWithTime($data_reservasi->tgl_pemesanan) }} WITA
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-lg-6">
                Tanggal Check-in
            </div>
            <div class="col-lg-6 text-end fw-bolder text-success">
                {{ DateHelpers::formatDateLocal($data_reservasi->tgl_book_check_in) }}
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-lg-6">
                Tanggal Check-out
            </div>
            <div class="col-lg-6 text-end fw-bolder text-success">
                {{ DateHelpers::formatDateLocal($data_reservasi->tgl_book_check_out) }}
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-lg-6">
                Durasi
            </div>
            <div class="col-lg-6 text-end fw-bolder text-primary">
                {{ $data_reservasi->durasi_reservasi }} Malam
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-lg-6 pt-1">
                Data User Pemesan
            </div>
            <div class="col-lg-6 text-end">
                (ID : {{ $data_reservasi->id_user }}) {{ $data_reservasi->user->nama }}&nbsp;&nbsp;&nbsp;<a href="{{ route('admin.data-customer.edit', [$data_reservasi->id_user]) }}" class="btn btn-primary btn-sm"><i class="fas fa-file"></i>&nbsp;&nbsp;Cek Data</a>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-lg-6">
                Nama Pemesan
            </div>
            <div class="col-lg-6 text-end">
                {{ $data_reservasi->nama_user }}
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-lg-6">
                Email Pemesan
            </div>
            <div class="col-lg-6 text-end">
                {{ $data_reservasi->email_user }}
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-lg-6">
                Asal Negara Pemesan
            </div>
            <div class="col-lg-6 text-end">
                {{ $data_reservasi->asal_negara_user }}
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-lg-6">
                No. Telp Pemesan
            </div>
            <div class="col-lg-6 text-end">
                {{ $data_reservasi->no_telp_user }}
            </div>
        </div>
        <hr class="dropdown-divider">
        <div class="fw-bolder mb-2">
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
        <hr class="dropdown-divider">
        <div class="col-lg-12 text-end">
            @if($data_reservasi->status_reservasi == "Menunggu Pembayaran" || $data_reservasi->status_reservasi == "Siap di Check-in")
                @php
                    $status_batal_reservasi = "";
                    foreach ($data_detail_reservasi as $kamar_reservasi) {
                        if($kamar_reservasi->datetime_check_in != null || $kamar_reservasi->datetime_check_out != null) {
                            $status_batal_reservasi = "gone";
                        }
                    }
                @endphp

                @if($status_batal_reservasi != "gone")
                    <a href="" class="btn btn-danger btn-batalkan" data-id="{{ $data_reservasi->id }}">
                        <i class="fas fa-times"></i>&nbsp;&nbsp;Batalkan Reservasi
                    </a>
                @else
                <a href="#" class="btn btn-danger disabled">
                    <i class="fas fa-times"></i>&nbsp;&nbsp;Batalkan Reservasi
                </a>
                @endif
            @else
                <a href="#" class="btn btn-danger disabled">
                    <i class="fas fa-times"></i>&nbsp;&nbsp;Batalkan Reservasi
                </a>
            @endif
            @if($data_reservasi->status_reservasi == "Menunggu Pembayaran")
                <a href="{{ route('admin.data-reservasi.telahDibayarkan', [$data_reservasi->id]) }}" class="btn btn-secondary">
                    <i class="fas fa-check"></i>&nbsp;&nbsp;Telah Dibayarkan
                </a>
            @elseif($data_reservasi->status_reservasi == "Siap di Check-in")
                @php
                    $status_batal_pembayaran = "";
                    foreach ($data_detail_reservasi as $kamar_reservasi) {
                        if($kamar_reservasi->datetime_check_in != null || $kamar_reservasi->datetime_check_out != null) {
                            $status_batal_pembayaran = "gone";
                        }
                    }
                @endphp
                @if($status_batal_pembayaran != "gone")
                    <a href="{{ route('admin.data-reservasi.batalPembayaran', [$data_reservasi->id]) }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times"></i>&nbsp;&nbsp;Batalkan Pembayaran
                    </a>
                @endif
            @endif
        </div>
        <hr class="dropdown-divider">
    </div>
</div>

<div class="card col-lg-12 mb-4">
    <div class="card-header">
        <div class="row">
            <div class="col-6 pt-1 fs-6">
                <i class="fas fa-table"></i>
                Daftar Kamar
            </div>
            <div class="col-6 text-end">
                @if($data_reservasi->status_reservasi == "Siap di Check-in")
                    <a href="{{ route('admin.data-reservasi.checkInAll', [$data_reservasi->id]) }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-check"></i>&nbsp;&nbsp;Check-in All Room
                    </a>
                @else
                    <a href="#" class="btn btn-primary btn-sm disabled">
                        <i class="fas fa-check"></i>&nbsp;&nbsp;Check-in All Room
                    </a>
                @endif
                
                @if($data_reservasi->status_reservasi == "Sudah Check-in")
                    <a href="{{ route('admin.data-reservasi.checkOutAll', [$data_reservasi->id]) }}" class="btn btn-success btn-sm">
                        <i class="fas fa-check"></i>&nbsp;&nbsp;Check-out All Room
                    </a>
                @else
                    <a href="#" class="btn btn-success disabled btn-sm">
                        <i class="fas fa-check"></i>&nbsp;&nbsp;Check-out All Room
                    </a>
                @endif
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-2 px-2">
            @foreach ($data_detail_reservasi as $detail_reservasi)
                <div class="card bg-secondary mb-2 py-1" style="--bs-bg-opacity: .08;">
                    <div class="card-body p-1">
                        <div class="row">
                            <div class="col-lg-6">
                                <small>Room Status</small>
                            </div>
                            <div class="col-lg-6 text-end">
                                @if ($detail_reservasi->status_reservasi_kamar == "Menunggu Pembayaran")
                                    <span class="badge bg-warning text-dark">{{ $detail_reservasi->status_reservasi_kamar }}</span>
                                @elseif($detail_reservasi->status_reservasi_kamar == "Siap di Check-in")
                                    <span class="badge bg-primary">{{ $detail_reservasi->status_reservasi_kamar }}</span>
                                @elseif($detail_reservasi->status_reservasi_kamar == "Sudah Check-in")
                                    <span class="badge bg-success">{{ $detail_reservasi->status_reservasi_kamar }}</span>
                                @elseif($detail_reservasi->status_reservasi_kamar == "Sudah Check-out")
                                    <span class="badge bg-success">{{ $detail_reservasi->status_reservasi_kamar }}</span>
                                @else
                                    <span class="badge bg-danger">{{ $detail_reservasi->status_reservasi_kamar }}</span>
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
                            <div class="col-lg-6">
                                <small>Check-in Date</small>
                            </div>
                            @if(!$detail_reservasi->datetime_check_in)
                                <div class="col-lg-6 text-end">
                                    <small>
                                        Haven't checked in yet
                                    </small>
                                </div>
                            @else
                                <div class="col-lg-6 text-end fw-bolder text-success">
                                    <small>
                                        ({{ $detail_reservasi->adminCheckIn->nama_admin }}) {{ DateHelpers::formatDateLocalWithTime($detail_reservasi->datetime_check_in) }} WITA
                                    </small>
                                </div>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <small>Check-out Date</small>
                            </div>
                            @if(!$detail_reservasi->datetime_check_out)
                                <div class="col-lg-6 text-end">
                                    <small>
                                        Haven't checked out yet
                                    </small>
                                </div>
                            @else
                                <div class="col-lg-6 text-end fw-bolder text-success">
                                    <small>
                                        ({{ $detail_reservasi->adminCheckOut->nama_admin }}) {{ DateHelpers::formatDateLocalWithTime($detail_reservasi->datetime_check_out) }} WITA
                                    </small>
                                </div>
                            @endif
                        </div>
                        <hr class="dropdown-divider">
                        <div class="col-lg-12 text-end">
                            @if($detail_reservasi->status_reservasi_kamar == "Siap di Check-in")
                                <a href="{{ route('admin.data-reservasi.checkInRoom', ['id_reservasi' => $data_reservasi->id, 'id_kamar' => $detail_reservasi->id]) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-check"></i>&nbsp;&nbsp;Check-in
                                </a>
                            @else
                                <a href="#" class="btn btn-primary btn-sm disabled">
                                    <i class="fas fa-check"></i>&nbsp;&nbsp;Check-in
                                </a>
                            @endif

                            
                            @if($detail_reservasi->status_reservasi_kamar == "Sudah Check-in")
                                <a href="{{ route('admin.data-reservasi.checkOutRoom', ['id_reservasi' => $data_reservasi->id, 'id_kamar' => $detail_reservasi->id]) }}" class="btn btn-success btn-sm">
                                    <i class="fas fa-check"></i>&nbsp;&nbsp;Check-out
                                </a>
                            @else
                                <a href="#" class="btn btn-success btn-sm disabled">
                                    <i class="fas fa-check"></i>&nbsp;&nbsp;Check-out
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $(function(){
        $(".btn-batalkan").click(function(e){
            e.preventDefault();
            let data_id = $(this).data('id');
            
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Reservasi akan dibatalkan secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Lanjut!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "/admin/data-reservasi/batal/"+data_id;
                }
            });
        });
    });
</script>
@endsection