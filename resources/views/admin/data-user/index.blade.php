@extends('admin/layout/master')

@section('title', 'Data User')

@section('content')
<div class="alert alert-primary mb-4" role="alert">
    Data User adalah pengelolaan data yang berisikan daftar dari user yang menggunakan website ini untuk melakukan pemesanan.
</div>
<div class="card mb-4">
    <div class="card-header">
        <div class="w-auto float-start mt-1 fs-5">
            <i class="fas fa-table me-1"></i>
            Data User
        </div>
        <a href="{{ route('admin.data-user.create') }}" class="btn btn-primary float-end">
            <i class="fas fa-plus"></i>
            Tambah Data
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
                    <th>Nama User</th>
                    <th>Email</th>
                    <th>Asal Negara</th>
                    <th>No Telp</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>#</th>
                    <th>Nama User</th>
                    <th>Email</th>
                    <th>Asal Negara</th>
                    <th>No Telp</th>
                    <th>Aksi</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach ($data_user as $user)
                <tr>
                    <td class="align-middle">{{ $loop->iteration }}</td>
                    <td class="align-middle">{{ $user->nama }}</td>
                    <td class="align-middle">{{ $user->email }}</td>
                    <td class="align-middle">{{ $user->asal_negara }}</td>
                    <td class="align-middle">{{ $user->no_telp }}</td>
                    <td class="align-middle">
                        <a href="{{ route('admin.data-user.edit', $user->id) }}" class="btn btn-success btn-sm">
                            <i class="fas fa-edit"></i>
                            Edit
                        </a>
                        <a href="#" class="btn btn-danger btn-sm btn-delete-data" data-id="{{ $user->id }}">
                            <i class="fas fa-trash"></i>
                            Delete
                        </a>
                        <form id="delete-data-{{ $user->id }}" action="{{ route('admin.data-user.destroy', $user->id) }}" method="POST" class="d-none">
                            @method('DELETE');
                            @csrf
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $(function(){
        $(".btn-delete-data").click(function(e){
            e.preventDefault();
            let data_id = $(this).data('id');
            
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Data akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#delete-data-"+data_id).submit();
                }
            });
        });
    });
</script>
@endsection