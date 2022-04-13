@extends('landing/layout/master')

@section('title', 'Cart List')

@section('content')
@if (\Session::has('error'))
    <script type="text/javascript">
    Swal.fire({
        icon: "error",
        title: "Order Failed",
        html: "{!! Session::get('error') !!}",
        confirmButtonColor: '#3085d6',
    });
    </script>
@endif
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
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-7">
            <h3 class="mb-4">
                Room Reservation Cart 
            </h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Room & Detail</th>
                        <th class="text-end">Price<small class="text-muted fw-light">/night</small></th>
                        <th class="text-end">Total</th>
                        <th class="text-center">#</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data_cart as $cart)
                        <tr>
                            <td>
                                <div class="align-items-center">
                                    <div class="image-cart-item" style="background-image: url('{{ asset('storage/img/img-kamar/'.$cart->kamar->gambar_kamar) }}')"></div>
                                    <div class="content-cart-item">
                                        <div class="fw-normal">
                                            {{ $cart->kamar->tipeKamar->tipe_kamar }} Room <span class="fw-bolder" style="font-size: 13px;">No. {{ $cart->kamar->no_kamar }}</span>
                                        </div>
                                        <small>
                                        <span class="text-muted">Adults: </span> {{ $cart->jumlah_dewasa }} &nbsp;
                                        <span class="text-muted">Children: </span> {{ $cart->jumlah_anak }}
                                        </small>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle text-end">
                                <input type="hidden" id="harga-kamar-cart{{ $cart->id }}" value="{{ $cart->kamar->harga_kamar }}">
                                Rp. {{  number_format($cart->kamar->harga_kamar,0,',','.') }}
                            </td>
                            <td class="align-middle text-end" id="text-total-harga-kamar{{ $cart->id }}">
                                <input type="hidden" id="total-kamar-cart{{ $cart->id }}" value="{{ $cart->kamar->harga_kamar }}">
                                Rp. {{  number_format($cart->kamar->harga_kamar,0,',','.') }}
                            </td>
                            <td class="align-middle text-center">
                                <a href="#" class="btn btn-outline-danger btn-sm btn-delete-data" data-id="{{ $cart->id }}">
                                    <i class="bi bi-trash"></i>
                                </a>
                                <form id="delete-data-{{ $cart->id }}" action="{{ route('landing.user.cartList.destroy', $cart->id) }}" method="POST" class="d-none">
                                    @method('DELETE');
                                    @csrf
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No rooms have been added to cart yet</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="col-lg-5">
            <div class="card mb-4">
                <div class="card-header">Booking Information Requirement</div>
                <div class="card-body">
                    <form action="{{ route('landing.user.processBooking') }}" method="POST" id="form-booking"> {{-- Form Action --}}
                        @csrf
                        <div class="row g-3 align-items-center">
                            <div class="col-md-6">
                                <div>
                                    <label for="" class="form-label">Check-in</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-calendar"></i></span>
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
                            <div class="col-md-6">
                                <div>
                                    <label for="" class="form-label">Duration</label>
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
                                            >{{ $i }} Night</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-2">
                            <div>
                                <label for="" class="form-label">Check-out</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                                    <input type="date" class="form-control" required name="check_out_date" value="@if(isset($request)){{$request->check_out_date}}@else{{ $date_checkout_start }}@endif" readonly id="check-out-date">
                                </div>
                            </div>
                        </div>
                        <p class="fw-light mt-3">* In 1 transaction, only 1 room reservation can be made on the same date </p>
                        <hr class="dropdown-divider" />
                        <div class="alert alert-primary" role="alert">
                            If you want to change the customer information, please change it on the profile settings page 
                        </div>
                        <div class="col-lg-12 mb-2">
                            <label class="form-label">Name</label>
                            <input type="text" readonly class="form-control @error('nama_user') is-invalid @enderror" value="{{ auth()->guard('web')->user()->nama }}" name="nama_user" placeholder="Enter your name...">
                            @error('nama_user')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="col-lg-12 mb-2">
                            <label class="form-label">Email</label>
                            <input type="email" readonly class="form-control @error('email_user') is-invalid @enderror" value="{{ auth()->guard('web')->user()->email }}" name="email_user" placeholder="Enter your email address...">
                            @error('email_user')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="row g-3 align-items-center">
                            <div class="col-lg-6 mb-2">
                                <label class="form-label">Country of Origin</label>
                                <input type="text" readonly class="form-control @error('asal_negara_user') is-invalid @enderror" value="{{ auth()->guard('web')->user()->asal_negara }}" name="asal_negara_user" placeholder="Enter your country of origin...">
                                @error('asal_negara_user')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="col-lg-6 mb-2">
                                <label class="form-label">Phone Number</label>
                                <input type="text" readonly class="form-control @error('no_telp_user') is-invalid @enderror" value="{{ auth()->guard('web')->user()->no_telp }}" name="no_telp_user" placeholder="Enter your phone number...">
                                @error('no_telp_user')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-warning" role="alert">
                Before making a booking, please check the <span class="fw-bolder">Booking Information Requirement</span>
            </div>
        </div>
        <div class="col-lg-12 mb-5">
            <div class="card border border-success bg-success bg-opacity-10">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="fs-6 text-success">
                                Total Payment
                            </div>
                            <div class="fs-4 fw-bolder text-success" id="text-total-pembayaran">
                                @php
                                    $total_pembayaran = 0;

                                    foreach($data_cart as $cart){
                                        $total_pembayaran += $cart->kamar->harga_kamar;
                                    }
                                @endphp
                                Rp. {{  number_format($total_pembayaran,0,',','.') }}
                            </div>
                        </div>
                        <div class="col-md-6 text-end">
                            <button type="button" class="btn btn-success" id="process-booking-now">
                                <i class="bi bi-journal-check"></i>&nbsp;&nbsp;Process Booking Now
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $(function(){
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

        $(".btn-delete-data").click(function(e){
            e.preventDefault();
            let data_id = $(this).data('id');
            
            Swal.fire({
                title: 'Are you sure?',
                text: "This room will be removed from cart!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete!',
                cancelButtonText: 'Cancle'
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#delete-data-"+data_id).submit();
                }
            });
        });

        var format = function(num){
            var str = num.toString().replace("", ""), parts = false, output = [], i = 1, formatted = null;
            if(str.indexOf(".") > 0) {
                parts = str.split(".");
                str = parts[0];
            }
            str = str.split("").reverse();
            for(var j = 0, len = str.length; j < len; j++) {
                if(str[j] != ",") {
                output.push(str[j]);
                if(i%3 == 0 && j < (len - 1)) {
                    output.push(".");
                }
                i++;
                }
            }
            formatted = output.reverse().join("");
            return("" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
        };

        $('#duration-select').change(function(){
            var duration = $(this).val();
            var total_pembayaran = 0;
            <?php
                foreach($data_cart as $cart){
            ?>
            var harga{{ $cart->id }} = $('#harga-kamar-cart{{ $cart->id }}').val();
            var total_harga{{ $cart->id }} = harga{{ $cart->id }} * duration;
            $('#total-kamar-cart{{ $cart->id }}').val(total_harga{{ $cart->id }});
            $('#text-total-harga-kamar{{ $cart->id }}').text("Rp. "+format(total_harga{{ $cart->id }}));
            total_pembayaran += total_harga{{ $cart->id }};
            <?php
                }
            ?>
            $('#text-total-pembayaran').text("Rp. "+format(total_pembayaran));
        });

        $('#process-booking-now').click(function(){
            $('#form-booking').submit();
        });
    });
</script>
@endsection