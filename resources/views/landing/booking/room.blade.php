@extends('landing/layout/master')

@section('title', 'Room Detail')

@section('content')
@if (\Session::has('success'))
<script type="text/javascript">
Swal.fire({
    icon: "success",
    title: "Successfully added to cart ",
    text: "{!! \Session::get('success') !!}",
    confirmButtonColor: '#3085d6',
});
</script>
@endif
<div class="container px-5 mt-5">
    <div class="row">
        <div class="col-lg-8">
            <!-- Post content-->
            <article>
                <!-- Post header-->
                <header class="mb-4">
                    
                    <div class="badge bg-primary bg-gradient rounded-pill mb-2">{{ $kamar->tipeKamar->tipe_kamar }}</div>
                    <!-- Post title-->
                    <h2 class="fw-bolder mb-2">
                        {{ $kamar->tipeKamar->tipe_kamar }} Room <span class="fs-3 fw-normal">No. {{ $kamar->no_kamar }}</span>
                    </h2>
                    <!-- Post categories-->
                    <h4 class="card-title pricing-card-title mb-2">Rp. {{ number_format($kamar->harga_kamar, 0,',','.') }}<small class="text-muted fw-light">/night</small></h4>
                </header>
                <!-- Preview image figure-->
                <figure class="mb-4">
                    <img class="img-fluid rounded" src="{{ asset('storage/img/img-kamar/'.$kamar->gambar_kamar) }}" alt="..." />
                </figure>
                <!-- Post content-->
                <section class="mb-5">
                    {!! $kamar->deskripsi_kamar !!}
                </section>
            </article>
        </div>
        <!-- Side widgets-->
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header">Booking</div>
                <div class="card-body">
                    @if(!Auth::guard('web')->check())
                        <div class="alert alert-warning" role="alert">
                            Please login first to make a room reservation 
                        </div>
                    @endif
                    <form action="{{ route('landing.booking.addToCart') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_kamar" value="{{ $kamar->id }}">
                        @error('id_kamar')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="row g-2 align-items-center">
                            <div class="col-lg-6">
                                <div>
                                    <div class="mb-3">
                                        <label class="form-label">Adults</label>
                                        <input type="number" @if(!Auth::guard('web')->check()) disabled @endif class="form-control @error('adults') is-invalid @enderror" value="{{ old('adults') }}" name="adults" placeholder="Amount...">
                                        @error('adults')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div>
                                    <div class="mb-3">
                                        <label class="form-label">Children</label>
                                        <input type="number" @if(!Auth::guard('web')->check()) disabled @endif class="form-control @error('children') is-invalid @enderror" value="{{ old('children') }}" name="children" placeholder="Amount...">
                                        @error('children')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button @if(!Auth::guard('web')->check()) disabled @endif type="submit" class="btn btn-primary">
                            <i class="bi bi-journal-arrow-down"></i>&nbsp;&nbsp;Booking Now
                        </button>
                    </form>
                    <p class="fw-light mt-3">* In 1 transaction, only 1 room reservation can be made on the same date </p>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="d-grid">
                    <a href="{{ route('landing.booking') }}" class="btn btn-success">Find Another Room</a>
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
    });
</script>
@endsection