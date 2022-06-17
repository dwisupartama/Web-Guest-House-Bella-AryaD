@extends('landing/layout/master')

@section('title', 'Booking')

@section('content')
    <!-- Page content-->
    <section class="pt-5">
        <div class="container px-5">
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
                                <input type="date" class="form-control" required name="check_in_date" min="{{$date_min_check_in}}" value="{{$date_min_check_in}}" id="check-in-date">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div>
                            <label for="" class="form-label">Check-out</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                                <input type="date" class="form-control" required name="check_out_date" min="{{$date_checkout_start}}" value="{{$date_checkout_start}}" id="check-out-date">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div>
                            <label for="" class="form-label">Duration</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="duration-select" required name="duration" value="1" readonly>
                                <span class="input-group-text" id="basic-addon2">Night</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="d-grid">
                            {{-- <input type="submit" class="btn btn-primary" value="Search" id="search-room" style="margin-top: 30px;"> --}}
                            <button class="btn btn-primary" type="button" id="search-room" style="margin-top: 30px;">Search</button>
                            <button class="btn btn-danger" type="button" id="reset-date" style="margin-top: 30px; display: none;">Reset</button>
                        </div>
                    </div>
                    <p class="fw-light">* In 1 transaction, only 1 room reservation can be made on the same date </p>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog preview section-->
    <section>
        <div class="container px-5">
            <div class="row gx-5" id="result-room">
                <div class="col-lg-12">
                    <div class="alert alert-light text-center" role="alert">
                        Choose the date when you want to book a room
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
<script type="text/javascript">
    $(function(){
        const DATE_IN_SAVEKEY = "date_check_in";
        const DATE_OUT_SAVEKEY = "date_check_out";
        const DURATION_SAVEKEY = "duration";

        if (typeof(Storage) !== "undefined") {
            if(localStorage.getItem(DATE_IN_SAVEKEY) !== null || localStorage.getItem(DATE_OUT_SAVEKEY) !== null || localStorage.getItem(DURATION_SAVEKEY) !== null){
                $("#check-in-date").val(localStorage.getItem(DATE_IN_SAVEKEY));
                $("#check-in-date").attr("readonly", true);
                $("#check-out-date").val(localStorage.getItem(DATE_OUT_SAVEKEY));
                $("#check-out-date").attr("readonly", true);
                $("#duration-select").val(localStorage.getItem(DURATION_SAVEKEY));
                $("#search-room").hide();
                $("#reset-date").show();

                $.ajax({
                    type: 'POST',
                    url: "{{ route('landing.booking.searchroom') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        check_in_date: localStorage.getItem(DATE_IN_SAVEKEY),
                        check_out_date: localStorage.getItem(DATE_OUT_SAVEKEY),
                        duration: localStorage.getItem(DURATION_SAVEKEY)
                    },
                    beforeSend: function(){
                        $('#result-room').html('<div class="text-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>');
                    },
                    success: function(data){
                        $('#result-room').html(data);
                    }
                });
            }
        }

        $("#check-in-date, #check-out-date").change(function(){
            var date_check_in = new Date($('#check-in-date').val());
            var date_check_out = new Date($('#check-out-date').val());

            var diff_in_time = date_check_out.getTime() - date_check_in.getTime();

            if($(this).attr('id') == "check-in-date"){
                var min_check_out = new Date(date_check_in);
                min_check_out.setDate(date_check_in.getDate()+1);

                var estimination_day = min_check_out.getDate();
                estimination_day = ""+estimination_day;
                var estimination_month = min_check_out.getMonth() + 1;
                estimination_month = ""+estimination_month;
                var estimination_year = min_check_out.getFullYear();
                if(estimination_day.length <= 1){
                    estimination_day = "0"+estimination_day;
                }
                if(estimination_month.length <= 1){
                    estimination_month = "0"+estimination_month;
                }
                var check_out_date = estimination_year+"-"+estimination_month+"-"+estimination_day;

                $("#check-out-date").attr("min", check_out_date);
                if(date_check_out <= date_check_in){
                    $("#check-out-date").attr("value", check_out_date);
                    diff_in_time = min_check_out.getTime() - date_check_in.getTime();
                }
            }
            
            var diff_in_days = diff_in_time / (1000 * 3600 * 24);

            $("#duration-select").attr("value",diff_in_days);
        });

        $("#search-room").click(function(e){
            var date_check_in = $('#check-in-date').val();
            var date_check_out = $('#check-out-date').val();
            var duration = $("#duration-select").val();

            if (typeof(Storage) !== "undefined") {
                localStorage.setItem(DATE_IN_SAVEKEY, date_check_in);
                localStorage.setItem(DATE_OUT_SAVEKEY, date_check_out);
                localStorage.setItem(DURATION_SAVEKEY, duration);

                location.reload();
            }
        });

        $("#reset-date").click(function(e){
            if (typeof(Storage) !== "undefined") {
                localStorage.removeItem(DATE_IN_SAVEKEY);
                localStorage.removeItem(DATE_OUT_SAVEKEY);
                localStorage.removeItem(DURATION_SAVEKEY);

                location.reload();
            }
        });
    });
</script>
@endsection