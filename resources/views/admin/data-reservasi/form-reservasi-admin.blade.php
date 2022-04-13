@extends('admin/layout/master')

@section('title', 'Tambah Data Reservasi')

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

<div class="alert alert-primary mb-4" role="alert">
    Lengkapi formulir berikut untuk melakukan pemesanan kamar pada customer
</div>
<div class="card mb-4">
    <div class="card-header">
        <div class="w-auto float-start fs-6">
            <i class="fas fa-door-open"></i>
            &nbsp;Pesanan Kamar
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
                    <th>Total Harga Kamar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data_cart as $cart_admin)
                <tr>
                    <td class="align-middle">{{ $loop->iteration }}</td>
                    <td class="align-middle">{{ $cart_admin->kamar->tipeKamar->tipe_kamar }} Room No. {{ $cart_admin->kamar->no_kamar }}</td>
                    <td class="align-middle">{{ $cart_admin->jumlah_dewasa }} Orang</td>
                    <td class="align-middle">{{ $cart_admin->jumlah_dewasa }} Orang</td>
                    <td class="align-middle">
                        <input type="hidden" id="harga-kamar-cart{{ $cart_admin->id }}" value="{{ $cart_admin->kamar->harga_kamar }}">
                        Rp. {{  number_format($cart_admin->kamar->harga_kamar,0,',','.') }}
                    </td>
                    <td class="align-middle" id="text-total-harga-kamar{{ $cart_admin->id }}">
                        <input type="hidden" id="total-kamar-cart{{ $cart_admin->id }}" value="{{ $cart_admin->kamar->harga_kamar }}">
                        Rp. {{  number_format($cart_admin->kamar->harga_kamar,0,',','.') }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-lg-8">
        <div class="card mb-4">
            <div class="card-header">
                <div class="w-auto float-start fs-6">
                    Informasi Booking
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.data-reservasi.buatReservasi') }}" method="POST" id="form-reservasi">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-lg-4">
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
                        <div class="col-lg-4">
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
                        <div class="col-lg-4">
                            <label for="" class="form-label">Check-out</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                <input type="date" class="form-control" required name="check_out_date" value="@if(isset($request)){{$request->check_out_date}}@else{{ $date_checkout_start }}@endif" readonly id="check-out-date">
                            </div>
                        </div>
                    </div>
                    <hr class="dropdown-divider">
                    <div class="row mb-3">
                        <input type="hidden" name="id_user" value="{{ $data_user->id }}">
                        <div class="col-lg-6">
                            <label class="form-label">Nama</label>
                            <input type="text" readonly class="form-control @error('nama_user') is-invalid @enderror" value="{{ $data_user->nama }}" name="nama_user" placeholder="Enter your name...">
                            @error('nama_user')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">Email</label>
                            <input type="email" readonly class="form-control @error('email_user') is-invalid @enderror" value="{{ $data_user->email }}" name="email_user" placeholder="Enter your email address...">
                            @error('email_user')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <label class="form-label">Asal Negara</label>
                            <input type="text" readonly class="form-control @error('asal_negara_user') is-invalid @enderror" value="{{ $data_user->asal_negara }}" name="asal_negara_user" placeholder="Enter your country of origin...">
                            @error('asal_negara_user')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">No. Telp</label>
                            <input type="text" readonly class="form-control @error('no_telp_user') is-invalid @enderror" value="{{ $data_user->no_telp }}" name="no_telp_user" placeholder="Enter your phone number...">
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
    <div class="col-lg-4">
        <div class="card border-0 bg-primary bg-opacity-10 mb-3">
            <div class="card-body">
                <div class="fs-6 fw-normal text-primary">Total Pembayaran</div>
                <div class="fs-3 fw-bold text-primary" id="text-total-pembayaran">
                    @php
                        $total_pembayaran = 0;

                        foreach($data_cart as $cart_admin){
                            $total_pembayaran += $cart_admin->kamar->harga_kamar;
                        }
                    @endphp
                    Rp. {{  number_format($total_pembayaran,0,',','.') }}
                </div>
            </div>
        </div>
        
        <div class="d-grid">
            <button type="submit" class="btn btn-primary btn-lg" id="buat-reservasi">
                <i class="fas fa-clipboard-list"></i>&nbsp;&nbsp;Buat Reservasi
            </button>
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

        $('#buat-reservasi').click(function(){
            $('#form-reservasi').submit();
        });
    });
</script>
@endsection