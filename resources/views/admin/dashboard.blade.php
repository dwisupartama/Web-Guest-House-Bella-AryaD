@extends('admin/layout/master')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card bg-primary text-white mb-4">
            <div class="card-body">
                <small>Reservasi Bertambah Hari Ini</small>
                <div class="fs-2 fw-bolder">
                    {{ $data_reservasi_bertambah_hari_ini->count() }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-warning text-white mb-4">
            <div class="card-body">
                <small>Reservasi Check-in Hari Ini</small>
                <div class="fs-2 fw-bolder">
                    {{ $data_reservasi_check_in_hari_ini->count() }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-success text-white mb-4">
            <div class="card-body">
                <small>Reservasi Bulan Ini</small>
                <div class="fs-2 fw-bolder">
                    {{ $data_reservasi_bulan_ini->count() }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-danger text-white mb-4">
            <div class="card-body">
                <small>Penghasilan Bulan Ini</small>
                <div class="fs-2 fw-bolder">
                    Rp . {{ number_format($data_penghasilan_bulan_ini,0,',','.') }}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-6">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-chart-area me-1"></i>
                Penghasilan per Bulan
            </div>
            <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-chart-bar me-1"></i>
                Penghasilan per Tahun
            </div>
            <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
        </div>
    </div>
</div>
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Rekap Reservasi
    </div>
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Asal Negara</th>
                    <th>No Telp</th>
                    <th>Tanggal Pemesanan</th>
                    <th>Check-in</th>
                    <th>Check-out</th>
                    <th>Durasi</th>
                    <th>Total Pembayaran</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data_rekap_reservasi as $rekap_reservasi)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $rekap_reservasi->nama_user }}</td>
                        <td>{{ $rekap_reservasi->asal_negara_user }}</td>
                        <td>{{ $rekap_reservasi->no_telp_user }}</td>
                        <td>{{ DateHelpers::formatDateLocalWithTime($rekap_reservasi->tgl_pemesanan) }}</td>
                        <td>{{ DateHelpers::formatDateLocal($rekap_reservasi->tgl_book_check_in) }}</td>
                        <td>{{ DateHelpers::formatDateLocal($rekap_reservasi->tgl_book_check_out) }}</td>
                        <td>{{ $rekap_reservasi->durasi_reservasi }} Malam</td>
                        <td>Rp . {{ number_format($rekap_reservasi->total_pembayaran,0,',','.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('script')
    <script type="text/javascript">
        // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#292b2c';

        // Area Chart Example
        var ctx = document.getElementById("myAreaChart");
        var ctx2 = document.getElementById("myBarChart");

        var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [@foreach($data_penghasilan_per_bulan as $penghasilan_per_bulan)"{{ \Carbon\Carbon::create()->day(1)->month($penghasilan_per_bulan->bulan)->locale('id')->monthName }}",@endforeach],
                datasets: [{
                label: "Penghasilan",
                lineTension: 0.3,
                backgroundColor: "rgba(2,117,216,0.2)",
                borderColor: "rgba(2,117,216,1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(2,117,216,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(2,117,216,1)",
                pointHitRadius: 50,
                pointBorderWidth: 2,
                data: [@foreach($data_penghasilan_per_bulan as $penghasilan_per_bulan)@if($loop->iteration == 1){{ $penghasilan_per_bulan->total }}@else,{{ $penghasilan_per_bulan->total }}@endif @endforeach],
                }],
            },
            options: {
                scales: {
                xAxes: [{
                    time: {
                    unit: 'date'
                    },
                    gridLines: {
                    display: false
                    },
                    ticks: {
                    maxTicksLimit: 7
                    }
                }],
                yAxes: [{
                    ticks: {
                    min: 0,
                    maxTicksLimit: 5
                    },
                    gridLines: {
                    color: "rgba(0, 0, 0, .125)",
                    }
                }],
                },
                legend: {
                display: false
                }
            }
        });

        var myLineChart2 = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: [@foreach($data_penghasilan_per_tahun as $penghasilan_per_tahun)"{{ $penghasilan_per_tahun->tahun }}",@endforeach],
            datasets: [{
            label: "Penghasilan",
            backgroundColor: "rgba(2,117,216,1)",
            borderColor: "rgba(2,117,216,1)",
            data: [@foreach($data_penghasilan_per_tahun as $penghasilan_per_tahun){{ $penghasilan_per_tahun->total }},@endforeach],
            }],
        },
        options: {
            scales: {
            xAxes: [{
                time: {
                unit: 'month'
                },
                gridLines: {
                display: false
                },
                ticks: {
                maxTicksLimit: 6
                }
            }],
            yAxes: [{
                ticks: {
                min: 0,
                maxTicksLimit: 5
                },
                gridLines: {
                display: true
                }
            }],
            },
            legend: {
            display: false
            }
        }
        });

    </script>
@endsection