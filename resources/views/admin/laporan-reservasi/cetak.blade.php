<!DOCTYPE html>
<html>

<head>
    <style>
        *{
            
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
        }

        #customers {
            width: 100%;
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            border-collapse: collapse;
        }

        #customers td,
        #customers th {
            border: 1px solid #000000;
            padding: 8px;
            font-size: 12pt;
        }

        #customers th {
            text-align: left;
            background-color: rgb(206, 206, 206);
            color: #000000;
        }

        #customers tr th:first-child, #customers tr td:first-child{
            text-align: center;
        }

        .title{
            width: 100%;
            text-align: center;
            font-family: 'Times New Roman', Times, serif;
            font-size: 14pt;
            font-weight: bold;
            margin: 0px;
        }
        .subtitle{
            width: 100%;
            text-align: center;
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            margin: 10px 0px 20px 0px;
        }

    </style>
</head>

<body>

    <p class="title">
        Data Laporan Bulanan
        <br>
        Pererenan Nengah Guest House
    </p>

    <table border="0" width="100%" style="margin-top: 20px; margin-bottom: 10px;">
        <tr>
            <td>
                <strong>Nama Admin :</strong> {{ auth()->guard('admin')->user()->nama_admin }}
            </td>
            <td>
                <strong>Periode :</strong> {{ \Carbon\Carbon::parse($periode)->locale('id')->monthName }} {{ \Carbon\Carbon::parse($periode)->year }}
            </td>
        </tr>
        <tr>
            <td>
                <strong>Tanggal Cetak :</strong> {{ DateHelpers::formatDateLocalWithTime(\Carbon\Carbon::now()) }}
            </td>
            <td>
                @php
                    $total_pendapatan = 0;
                    foreach ($data_laporan as $laporan) {
                        $total_pendapatan += $laporan->total_harga_kamar;
                    }
                @endphp
                <strong>Total Pendapatan Bulan :</strong> Rp . {{ number_format($total_pendapatan,0,',','.') }}
            </td>
        </tr>
    </table>

    <table id="customers">
        <tr>
            <th>#</th>
            <th>No. Reservasi</th>
            <th>Nama</th>
            <th>Asal Negara</th>
            <th>No. Telp</th>
            <th style="text-align: center;">Tanggal Pemesanan</th>
            <th style="text-align: center;">Dewasa</th>
            <th style="text-align: center;">Anak</th>
            <th style="text-align: center;">Check In</th>
            <th style="text-align: center;">Check Out</th>
            <th>Status</th>
            <th style="text-align: center;">Total Harga</th>
        </tr>
        @forelse ($data_laporan as $laporan)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $laporan->no_reservasi }}</td>
            <td>{{ $laporan->nama_user }}</td>
            <td>{{ $laporan->asal_negara_user }}</td>
            <td>{{ $laporan->no_telp_user }}</td>
            <td style="text-align: right;">{{ DateHelpers::formatDateLocalWithTime($laporan->tgl_pemesanan) }}</td>
            <td style="text-align: center;">{{ $laporan->jumlah_dewasa }}</td>
            <td style="text-align: center;">{{ $laporan->jumlah_anak }}</td>
            <td style="text-align: right;">{{ DateHelpers::formatDateLocal($laporan->tgl_book_check_in) }}</td>
            <td style="text-align: right;">{{ DateHelpers::formatDateLocal($laporan->tgl_book_check_out) }}</td>
            <td>{{ $laporan->status_reservasi_kamar }}</td>
            <td style="text-align: right;">Rp . {{ number_format($laporan->total_harga_kamar,0,',','.') }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="12">Belum ada data laporan pada bulan ini</td>
        </tr>
        @endforelse
    </table>

</body>

</html>
