@extends('landing/layout/master')

@section('title', 'Booking')

@section('content')
    <!-- Page content-->
    <section class="pt-5">
        <div class="container px-5">
            <form action="{{ route('landing.booking.withData') }}" method="POST">
                @csrf
                <div class="bg-light rounded-3 py-4 px-4 px-md-5 mb-5">
                    <div class="row g-3 align-items-center">
                        <div class="col-lg-3">
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
                        <div class="col-lg-2">
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
                        <div class="col-lg-3">
                            <div>
                                <label for="" class="form-label">Check-out</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                                    <input type="date" class="form-control" required name="check_out_date" value="@if(isset($request)){{$request->check_out_date}}@else{{ $date_checkout_start }}@endif" readonly id="check-out-date">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div>
                                <label for="" class="form-label">Room Type</label>
                                <select class="form-select" id="" name="room_type" required>
                                    <option value="">Choose Type</option>
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
                                <input type="submit" class="btn btn-primary" value="Search" style="margin-top: 30px;">
                            </div>
                        </div>
                        <p class="fw-light">* In 1 transaction, only 1 room reservation can be made on the same date </p>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- Blog preview section-->
    <section>
        <div class="container px-5">
            <div class="row gx-5">
                @isset($data_kamar)
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
                            <div class="alert alert-light text-center" role="alert">
                                There are no rooms of that type available on that date 
                            </div>
                        </div>
                    @endforelse
                @else
                    <div class="col-lg-12">
                        <div class="alert alert-light text-center" role="alert">
                            Choose the date when you want to book a room
                        </div>
                    </div>
                @endisset
            </div>
        </div>
    </section>
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
    });
</script>
@endsection