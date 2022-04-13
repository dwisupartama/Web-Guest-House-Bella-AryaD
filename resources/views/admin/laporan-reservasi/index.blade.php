@extends('admin/layout/master')

@section('title', 'Laporan Reservasi')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('content')
<!-- Modal -->
<div class="modal fade" id="modal-cetak" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content" id="body-modal-cetak">
            
        </div>
    </div>
</div>

<div class="alert alert-primary mb-4" role="alert">
    Laporan Reservasi berisikan rekapan data dari customer yang telah melakukan reservasi
</div>
<div class="card mb-4">
    <div class="card-header">
        <div class="w-auto float-start mt-1 fs-5">
            <i class="fas fa-calendar me-1"></i>
            Calendar Reservasi
        </div>
        <a href="#" class="btn btn-primary float-end @if($data_reservasi->count() < 1) disabled @endif" id="btn-cetak-laporan">
            <i class="fas fa-print" id="icon-button-print"></i>
            <div class="d-none spinner-border spinner-border-sm text-light" role="status" id="loading-print">
                <span class="visually-hidden">Loading...</span>
            </div>
            &nbsp;Cetak Laporan
        </a>
    </div>
    <div class="card-body">
        <div id="calendar"></div>
    </div>
</div>
@endsection

@section('script')
    <script type="text/javascript">
        $(function(){
            $('#btn-cetak-laporan').click(function(e){
                e.preventDefault();
                $.ajax({
                    url: "{{ route('admin.laporan-reservasi.modalCetakLaporan') }}",
                    method: "GET",
                    beforeSend: function(){
                        $("#loading-print").removeClass("d-none");
                        $("#icon-button-print").addClass("d-none");
                    },
                    success: function(data){
                        $("#loading-print").addClass("d-none");
                        $("#icon-button-print").removeClass("d-none");
                        $("#body-modal-cetak").html(data);
                        $("#modal-cetak").modal('show');
                    }
                })
            });
        });
    </script>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'today prev,next',
                    center: 'title',
                    right: 'dayGridMonth',
                },
                displayEventTime: false,
                themeSystem: 'bootstrap5',
                events: [
                    <?php
                    foreach($data_reservasi as $reservasi){
                        $detail_reservasi = $data_detail_reservasi->where('id_reservasi', $reservasi->id);
                        $kamar = "(";
                        $i = 0;
                        foreach($detail_reservasi as $detail){
                            if($i == 0){
                                $kamar .= $detail->kamar->tipeKamar->tipe_kamar." No. ".$detail->kamar->no_kamar;
                            }else{
                                $kamar .= ", ".$detail->kamar->tipeKamar->tipe_kamar." No. ".$detail->kamar->no_kamar;
                            }
                            $i++;
                        }
                        $kamar .= ")";
                    ?>
                    {
                        "title": "{{ $reservasi->nama_user.' '.$kamar }}",
                        "start": "{{ $reservasi->tgl_book_check_in }}",
                        "end": "{{ \Carbon\Carbon::parse($reservasi->tgl_book_check_out)->addDay(1) }}"
                    },
                    <?php
                    }
                    ?>
                ],
            });
            calendar.render();
        });
    </script>
@endsection