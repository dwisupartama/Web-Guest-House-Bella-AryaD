@extends('landing/layout/master')

@section('title', 'Booking')

@section('content')
    <!-- Page content-->
    <section class="pt-5">
        <div class="container px-5">
            <!-- Contact form-->
            <div class="bg-light rounded-3 py-4 px-4 px-md-5 mb-5">
                <div class="row g-3 align-items-center">
                    <div class="col-lg-3">
                        <div>
                            <label for="" class="form-label">Check-in</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                                <?php
                                    date_default_timezone_set("Asia/Kuala_Lumpur");
                                    $date_now = date('Y-m-d');
                                    $date_min_check_in = date("Y-m-d", strtotime("+1 day"));
                                    $date_checkout_start = date("Y-m-d", strtotime("+2 day"));
                                ?>
                                <input type="date" class="form-control" name="check-in-date" min="<?= $date_min_check_in ?>" value="{{ $date_min_check_in }}" id="check-in-date">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div>
                            <label for="" class="form-label">Duration</label>
                            <select class="form-select" id="duration-select">
                                @for ($i = 1; $i <= 30; $i++)
                                    <option value="{{ $i }}" @if ($i == 1) selected @endif >{{ $i }} Night</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div>
                            <label for="" class="form-label">Check-out</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                                <input type="date" class="form-control" name="check-out-date" value="{{ $date_checkout_start }}" readonly id="check-out-date">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div>
                            <label for="" class="form-label">Room Type</label>
                            <select class="form-select" id="">
                                <option selected>Choose Type</option>
                                <option value="Deluxe">Deluxe</option>
                                <option value="Superior">Superior</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="d-grid">
                            <input type="submit" class="btn btn-primary" value="Search" style="margin-top: 30px;">
                          </div>
                    </div>
                  </div>
            </div>
        </div>
    </section>
    <!-- Blog preview section-->
    <section>
        <div class="container px-5">
            <div class="row gx-5">
                <div class="col-lg-4 mb-5">
                    <div class="card h-100 shadow border-0">
                        <img class="card-img-top" src="https://dummyimage.com/600x350/ced4da/6c757d" alt="..." />
                        <div class="card-body p-4">
                            <div class="badge bg-primary bg-gradient rounded-pill mb-2">Deluxe</div>
                            <a class="text-decoration-none link-dark" href="#!"><h5 class="card-title mb-3">Deluxe Room <span class="fs-6 fw-normal">No. 1</span></h5></a>
                            <p class="card-text mb-0">
                                This room has facilities in the form of 2 single beds, ac, tv, private bathroom, and wifi
                            </p>
                            <h5 class="card-title pricing-card-title mt-2">Rp. 400.000<small class="text-muted fw-light">/night</small></h5>
                        </div>
                        <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
                            <div class="d-flex align-items-end justify-content-between">
                                <a href="" class="btn btn-primary">Booking Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-5">
                    <div class="card h-100 shadow border-0">
                        <img class="card-img-top" src="https://dummyimage.com/600x350/ced4da/6c757d" alt="..." />
                        <div class="card-body p-4">
                            <div class="badge bg-primary bg-gradient rounded-pill mb-2">Deluxe</div>
                            <a class="text-decoration-none link-dark" href="#!"><h5 class="card-title mb-3">Deluxe Room <span class="fs-6 fw-normal">No. 1</span></h5></a>
                            <p class="card-text mb-0">
                                This room has facilities in the form of 2 single beds, ac, tv, private bathroom, and wifi
                            </p>
                            <h5 class="card-title pricing-card-title mt-2">Rp. 400.000<small class="text-muted fw-light">/night</small></h5>
                        </div>
                        <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
                            <div class="d-flex align-items-end justify-content-between">
                                <a href="" class="btn btn-primary">Booking Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-5">
                    <div class="card h-100 shadow border-0">
                        <img class="card-img-top" src="https://dummyimage.com/600x350/ced4da/6c757d" alt="..." />
                        <div class="card-body p-4">
                            <div class="badge bg-primary bg-gradient rounded-pill mb-2">Deluxe</div>
                            <a class="text-decoration-none link-dark" href="#!"><h5 class="card-title mb-3">Deluxe Room <span class="fs-6 fw-normal">No. 1</span></h5></a>
                            <p class="card-text mb-0">
                                This room has facilities in the form of 2 single beds, ac, tv, private bathroom, and wifi
                            </p>
                            <h5 class="card-title pricing-card-title mt-2">Rp. 400.000<small class="text-muted fw-light">/night</small></h5>
                        </div>
                        <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
                            <div class="d-flex align-items-end justify-content-between">
                                <a href="" class="btn btn-primary">Booking Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-5">
                    <div class="card h-100 shadow border-0">
                        <img class="card-img-top" src="https://dummyimage.com/600x350/ced4da/6c757d" alt="..." />
                        <div class="card-body p-4">
                            <div class="badge bg-primary bg-gradient rounded-pill mb-2">Deluxe</div>
                            <a class="text-decoration-none link-dark" href="#!"><h5 class="card-title mb-3">Deluxe Room <span class="fs-6 fw-normal">No. 1</span></h5></a>
                            <p class="card-text mb-0">
                                This room has facilities in the form of 2 single beds, ac, tv, private bathroom, and wifi
                            </p>
                            <h5 class="card-title pricing-card-title mt-2">Rp. 400.000<small class="text-muted fw-light">/night</small></h5>
                        </div>
                        <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
                            <div class="d-flex align-items-end justify-content-between">
                                <a href="" class="btn btn-primary">Booking Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-5">
                    <div class="card h-100 shadow border-0">
                        <img class="card-img-top" src="https://dummyimage.com/600x350/ced4da/6c757d" alt="..." />
                        <div class="card-body p-4">
                            <div class="badge bg-primary bg-gradient rounded-pill mb-2">Deluxe</div>
                            <a class="text-decoration-none link-dark" href="#!"><h5 class="card-title mb-3">Deluxe Room <span class="fs-6 fw-normal">No. 1</span></h5></a>
                            <p class="card-text mb-0">
                                This room has facilities in the form of 2 single beds, ac, tv, private bathroom, and wifi
                            </p>
                            <h5 class="card-title pricing-card-title mt-2">Rp. 400.000<small class="text-muted fw-light">/night</small></h5>
                        </div>
                        <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
                            <div class="d-flex align-items-end justify-content-between">
                                <a href="" class="btn btn-primary">Booking Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-5">
                    <div class="card h-100 shadow border-0">
                        <img class="card-img-top" src="https://dummyimage.com/600x350/ced4da/6c757d" alt="..." />
                        <div class="card-body p-4">
                            <div class="badge bg-primary bg-gradient rounded-pill mb-2">Deluxe</div>
                            <a class="text-decoration-none link-dark" href="#!"><h5 class="card-title mb-3">Deluxe Room <span class="fs-6 fw-normal">No. 1</span></h5></a>
                            <p class="card-text mb-0">
                                This room has facilities in the form of 2 single beds, ac, tv, private bathroom, and wifi
                            </p>
                            <h5 class="card-title pricing-card-title mt-2">Rp. 400.000<small class="text-muted fw-light">/night</small></h5>
                        </div>
                        <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
                            <div class="d-flex align-items-end justify-content-between">
                                <a href="" class="btn btn-primary">Booking Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
@endsection

@section('script')
<script type="text/javascript">
    $(function(){
        // $("#check-in-date").change(function(){
        //     var date = new Date($(this).val());

        //     var nextDate = new Date(date);
        //     nextDate.setDate(date.getDate()+1);

        //     var newDay = nextDate.getDate();
        //     newDay = ""+newDay;
        //     var newMonth = nextDate.getMonth() + 1;
        //     newMonth = ""+newMonth;
        //     var newYear = nextDate.getFullYear();

        //     if(newDay.length <= 1){
        //         newDay = "0"+newDay;
        //     }

        //     if(newMonth.length <= 1){
        //         newMonth = "0"+newMonth;
        //     }

        //     var minCheckIn = newYear+"-"+newMonth+"-"+newDay;

        //     $("#check-out-date").val("");
        //     $("#check-out-date").attr("min",minCheckIn);
        //     // alert(newMonth.length);
        // });
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