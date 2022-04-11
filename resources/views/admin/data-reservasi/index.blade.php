@extends('admin/layout/master')

@section('title', 'Data Reservasi')

@section('content')
<div class="alert alert-primary mb-4" role="alert">
    Data Reservasi adalah pengelolaan data yang berisikan daftar dari reservasi yang dipesan oleh customer.
</div>
<div class="card mb-4">
    <div class="card-header">
        <div class="w-auto float-start mt-1 fs-5">
            <i class="fas fa-table me-1"></i>
            Data Reservasi
        </div>
        <a href="" class="btn btn-primary float-end disabled">
            <i class="fas fa-plus"></i>
            Tambah Reservasi
        </a>
    </div>
    
    
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
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>#</th>
                    <th>No. Reservasi</th>
                    <th>Nama</th>
                    <th>Tanggal Check-in</th>
                    <th>Tanggal Check-out</th>
                    <th>Status Reservasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data_reservasi as $reservasi)
                <tr>
                    <td class="align-middle">{{ $loop->iteration }}</td>
                    <td class="align-middle">{{ $reservasi->no_reservasi }}</td>
                    <td class="align-middle">{{ $reservasi->nama_user }}</td>
                    <td class="align-middle">{{ DateHelpers::formatDateLocal($reservasi->tgl_book_check_in) }}</td>
                    <td class="align-middle">{{ DateHelpers::formatDateLocal($reservasi->tgl_book_check_out) }}</td>
                    <td class="align-middle">{{ $reservasi->status_reservasi }}</td>
                    <td class="align-middle">
                        <a href="{{ route('admin.data-reservasi.proses', [$reservasi->id]) }}" class="btn btn-success btn-sm mb-1 mt-1">
                            <i class="fas fa-pen"></i>&nbsp;&nbsp;Proses
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection