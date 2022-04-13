@extends('admin/layout/master')

@section('title', 'Tambah Data Reservasi')

@section('content')

<div class="alert alert-primary mb-4" role="alert">
    Pilih customer yang memesan kamar tersebut
</div>
<div class="card mb-4">
    <div class="card-header">
        <div class="w-auto float-start fs-6">
            <i class="fas fa-user"></i>
            Data User
        </div>
    </div>
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Asal Negara</th>
                    <th>No. Telp</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data_user as $user)
                <tr>
                    <td class="align-middle">{{ $loop->iteration }}</td>
                    <td class="align-middle">{{ $user->nama }}</td>
                    <td class="align-middle">{{ $user->email }}</td>
                    <td class="align-middle">{{ $user->asal_negara }}</td>
                    <td class="align-middle">{{ $user->no_telp }}</td>
                    <td class="align-middle">
                        <a href="{{ route('admin.data-reservasi.formReservasiAdmin', [$user->id]) }}" class="btn btn-success btn-sm btn-pilih-user">
                            <i class="fas fa-user-check"></i>&nbsp;&nbsp;Pilih User
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="row mt-2">
            <div class="col-lg-6">
                <a href="{{ route('admin.data-reservasi.create') }}" class="btn btn-primary">
                    <i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Kembali
                </a>
            </div>
            <div class="col-lg-6 text-end">
            </div>
        </div>
    </div>
</div>
@endsection