@extends('admin/layout/master')

@section('title', 'Tambah Data Reservasi')

@section('content')

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


@if (\Session::has('error'))
<script type="text/javascript">
Swal.fire({
    icon: "error",
    title: "Gagal",
    text: "{!! \Session::get('error') !!}",
    confirmButtonColor: '#3085d6',
});
</script>
@endif

<!-- Modal -->
<div class="modal fade" id="modal-jumlah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="content-form-cart">
            
        </div>
    </div>
</div>

<div class="alert alert-primary mb-4" role="alert">
    Tambahkan kamar yang ingin dipesan oleh customer terlebih dahulu
</div>
<div class="card mb-4">
    <div class="card-header">
        <div class="w-auto float-start fs-6">
            <i class="fas fa-shopping-cart"></i>
            Data Cart
        </div>
    </div>
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Kamar</th>
                    <th>Dewasa</th>
                    <th>Anak - Anak</th>
                    <th>Harga<small class="text-muted fw-light">/malam</small></th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data_cart_admin as $cart_admin)
                <tr>
                    <td class="align-middle">{{ $loop->iteration }}</td>
                    <td class="align-middle">{{ $cart_admin->kamar->tipeKamar->tipe_kamar }} Room No. {{ $cart_admin->kamar->no_kamar }}</td>
                    <td class="align-middle">{{ $cart_admin->jumlah_dewasa }} Orang</td>
                    <td class="align-middle">{{ $cart_admin->jumlah_dewasa }} Orang</td>
                    <td class="align-middle">Rp. {{  number_format($cart_admin->kamar->harga_kamar,0,',','.') }}</td>
                    <td class="align-middle">
                        <a href="#" class="btn btn-danger btn-sm btn-hapus-cart" data-id="{{ $cart_admin->id }}">
                            <i class="fas fa-trash"></i>&nbsp;&nbsp;Hapus    
                        </a>
                        <form id="delete-cart-{{ $cart_admin->id }}" action="{{ route('admin.data-reservasi.cart.destroy', [$cart_admin->id]) }}" method="POST" class="d-none">
                            @method('DELETE');
                            @csrf
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="row">
            <div class="col-lg-6">
            </div>
            <div class="col-lg-6 text-end">
                <a href="{{ route('admin.data-reservasi.pilihUser') }}" class="btn btn-primary @if($data_cart_admin->count() < 1) disabled @endif btn-lg">
                    Selanjutnya&nbsp;&nbsp;<i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-12">
    <form action="{{ route('admin.data-reservasi.search') }}" method="POST">
        @csrf
        <div class="bg-success rounded-3 pt-3 pb-4 px-4 mb-5 bg-opacity-10">
            <div class="row g-3 align-items-center">
                <div class="col-lg-3">
                    <div>
                        <label for="" class="form-label">Check-in</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                            @php
                                date_default_timezone_set("Asia/Kuala_Lumpur");
                                $date_now = date('Y-m-d');
                                $date_min_check_in = date("Y-m-d", strtotime("+1 day"));
                                $date_checkout_start = date("Y-m-d", strtotime("+2 day"));
                            @endphp
                            <input type="date" class="form-control" required name="check_in_date" min="<?= $date_min_check_in ?>" value="@if(isset($request)){{$request->check_in_date}}@else{{$date_min_check_in}}@endif" id="check-in-date">
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div>
                        <label for="" class="form-label">Durasi</label>
                        <select class="form-select" id="duration-select" required name="duration">
                            @for ($i = 1; $i <= 30; $i++)
                                <option value="{{ $i }}"
                                    @if(isset($request))
                                        @if ($i == $request->duration)
                                            selected
                                        @endif
                                    @else
                                        @if ($i == 1)
                                            selected
                                        @endif
                                    @endif
                                >{{ $i }} Malam</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div>
                        <label for="" class="form-label">Check-out</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                            <input type="date" class="form-control" required name="check_out_date" value="@if(isset($request)){{$request->check_out_date}}@else{{ $date_checkout_start }}@endif" readonly id="check-out-date">
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div>
                        <label for="" class="form-label">Tipe Kamar</label>
                        <select class="form-select" id="" name="room_type" required>
                            <option value="">Pilih Tipe</option>
                            @foreach($data_tipe_kamar as $tipe_kamar)
                                <option value="{{ $tipe_kamar->id }}"
                                    @if(isset($request))
                                        @if($tipe_kamar->id == $request->room_type)
                                            selected
                                        @endif
                                    @endif
                                >{{ $tipe_kamar->tipe_kamar }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary" style="margin-top: 30px;">
                            Cari
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@isset($data_kamar)
    <div class="card mb-4">
        <div class="card-header">
            <div class="w-auto float-start fs-6">
                <i class="fas fa-door-open"></i>
                Hasil Cari Kamar
            </div>
        </div>
        <div class="card-body">
            <table id="datatablesSimple2">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>No. Kamar</th>
                        <th>Tipe Kamar</th>
                        <th>Harga<small class="text-muted fw-light">/malam</small></th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_kamar as $kamar)
                    <tr>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">
                            No. {{ $kamar->no_kamar }}
                        </td>
                        <td class="align-middle">
                            {{ $kamar->tipeKamar->tipe_kamar }}
                        </td>
                        <td class="align-middle">Rp. {{  number_format($kamar->harga_kamar,0,',','.') }}</td>
                        <td class="align-middle">
                            <button type="submit" class="btn btn-success btn-tambahkan-kamar
                            @php
                                $disabled = "";

                                foreach($data_cart_admin as $cart_admin){
                                    if($cart_admin->id_kamar == $kamar->id){
                                        $disabled = "disabled";
                                    }
                                }

                                echo($disabled);
                            @endphp
                            " data-id="{{ $kamar->id }}">
                                <i class="fas fa-plus" id="icon-button-tambah-{{ $kamar->id }}"></i>
                                <div class="d-none spinner-border spinner-border-sm text-light" role="status" id="loading-tambah-{{ $kamar->id }}">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                &nbsp;Tambahkan Kamar
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endisset
@endsection

@section('script')
<script type="text/javascript">
    $(function(){
        $('.btn-tambahkan-kamar').click(function(){
            var id = $(this).data('id');
            var url = "{{ route('admin.data-reservasi.formAddCart', [":id"]) }}";
            url = url.replace(':id', id);

            $.ajax({
                url: url,
                method: "GET",
                beforeSend: function(){
                    $("#loading-tambah-"+id).removeClass("d-none");
                    $("#icon-button-tambah-"+id).addClass("d-none");
                },
                success: function(data){
                    $("#loading-tambah-"+id).addClass("d-none");
                    $("#icon-button-tambah-"+id).removeClass("d-none");
                    $("#content-form-cart").html(data);
                    $("#modal-jumlah").modal('show');
                }
            })
        });

        $("#check-in-date, #duration-select").change(function(){
            var date_check_in = new Date($('#check-in-date').val());
            var duration = $('#duration-select').find('option:selected').val();

            var check_out_estimination = new Date(date_check_in);
            check_out_estimination.setDate(date_check_in.getDate()+parseInt(duration));

            var estimination_day = check_out_estimination.getDate();
            estimination_day = ""+estimination_day;
            var estimination_month = check_out_estimination.getMonth() + 1;
            estimination_month = ""+estimination_month;
            var estimination_year = check_out_estimination.getFullYear();

            if(estimination_day.length <= 1){
                estimination_day = "0"+estimination_day;
            }

            if(estimination_month.length <= 1){
                estimination_month = "0"+estimination_month;
            }

            var check_out_date = estimination_year+"-"+estimination_month+"-"+estimination_day;
            $("#check-out-date").attr("value",check_out_date);
        });
    
        $(".btn-hapus-cart").click(function(e){
            e.preventDefault();
            let data_id = $(this).data('id');
            
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Kamar ini akan dihapus dari cart!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#delete-cart-"+data_id).submit();
                }
            });
        });
    });
</script>
@endsection