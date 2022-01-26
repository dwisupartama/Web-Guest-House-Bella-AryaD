@extends('admin/layout/master')

@section('title', 'Data Admin')

@section('content')
<div class="alert alert-primary mb-4" role="alert">
    Data Admin adalah pengelolaan data yang berisikan daftar dari admin yang bertugas untuk mengelola halaman admin dari website.
</div>
<div class="card mb-4">
    <div class="card-header">
        <div class="w-auto float-start mt-1 fs-5">
            <i class="fas fa-table me-1"></i>
            Data Admin
        </div>
        <a href="{{ route('admin.data-admin.create') }}" class="btn btn-primary float-end">
            <i class="fas fa-plus"></i>
            Tambah Data
        </a>
    </div>
    
    
    @if (\Session::has('success'))
    <script type="text/javascript">
    Swal.fire({
        icon: "success",
        title: "Berhasil",
        text: "{!! \Session::get('success') !!}"
    });
    </script>
    @endif
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Admin</th>
                    <th>Username</th>
                    <th>Alamat Admin</th>
                    <th>No Telp</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>#</th>
                    <th>Nama Admin</th>
                    <th>Username</th>
                    <th>Alamat Admin</th>
                    <th>No Telp</th>
                    <th>Aksi</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach ($data_admin as $admin)
                <tr>
                    <td class="align-middle">{{ $loop->iteration }}</td>
                    <td class="align-middle">{{ $admin->nama_admin }}</td>
                    <td class="align-middle">{{ $admin->username }}</td>
                    <td class="align-middle">{{ $admin->alamat_admin }}</td>
                    <td class="align-middle">{{ $admin->no_telp }}</td>
                    <td class="align-middle">
                        <a href="/admin/data-admin/{{ $admin->id }}/edit" class="btn btn-success btn-sm">
                            <i class="fas fa-edit"></i>
                            Edit
                        </a>
                        <a href="" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i>
                            Delete
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection