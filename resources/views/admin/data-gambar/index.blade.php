@extends('admin/layout/master')

@section('title', 'Data Galeri')

@section('content')
<div class="alert alert-primary mb-4" role="alert">
    Data Galeri adalah pengelolaan data yang berisikan daftar dari gambar yang terdapat pada konten.
</div>
<div class="card mb-4">
    <div class="card-header">
        <div class="w-auto float-start mt-1 fs-5">
            <i class="fas fa-table me-1"></i>
            Data Galeri
        </div>
        <a href="{{ route('admin.data-gambar.create') }}" class="btn btn-primary float-end">
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
                    <th>Gambar</th>
                    <th>Nama Gambar</th>
                    <th>Konten</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>#</th>
                    <th>Gambar</th>
                    <th>Nama Gambar</th>
                    <th>Konten</th>
                    <th>Aksi</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach ($data_gambar as $gambar)
                <tr>
                    <td class="align-middle">{{ $loop->iteration }}</td>
                    <td class="align-middle">
                        <img src="{{ asset('storage/img/img-konten/'.$gambar->link_gambar) }}" class="img-thumbnail" style="width: 200px; height: auto;" alt="...">
                    </td>
                    <td class="align-middle">{{ $gambar->nama_gambar }}</td>
                    <td class="align-middle">{{ $gambar->konten->judul_konten }}</td>
                    <td class="align-middle">
                        <a href="{{ route('admin.data-gambar.edit', $gambar->id) }}" class="btn btn-success btn-sm">
                            <i class="fas fa-edit"></i>
                            Edit
                        </a>
                        <a href="#" class="btn btn-danger btn-sm btn-delete-data" data-id="{{ $gambar->id }}">
                            <i class="fas fa-trash"></i>
                            Delete
                        </a>
                        <form id="delete-data-{{ $gambar->id }}" action="{{ route('admin.data-gambar.destroy', $gambar->id) }}" method="POST" class="d-none">
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