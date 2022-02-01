@extends('admin/layout/master')

@section('title', 'Data Kamar')

@section('content')

<!-- Modal -->
<div class="modal fade" id="modal-show-image-kamar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Gambar Kamar</h5>
        </div>
        <div class="modal-body">
            <img src="" id="img-kamar" class="rounded img-fluid" alt="Gambar Kamar">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>

<div class="alert alert-primary mb-4" role="alert">
    Data Kamar adalah pengelolaan data yang berisikan daftar dari kamar yang dapat dipesan dalam website ini.
</div>
<div class="card mb-4">
    <div class="card-header">
        <div class="w-auto float-start mt-1 fs-5">
            <i class="fas fa-table me-1"></i>
            Data Kamar
        </div>
        <a href="{{ route('admin.data-kamar.create') }}" class="btn btn-primary float-end">
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
                    <th>No. Kamar</th>
                    <th>Tipe Kamar</th>
                    <th>Gambar Kamar</th>
                    <th>Harga Kamar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>#</th>
                    <th>No. Kamar</th>
                    <th>Tipe Kamar</th>
                    <th>Gambar Kamar</th>
                    <th>Harga Kamar</th>
                    <th>Aksi</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach ($data_kamar as $kamar)
                <tr>
                    <td class="align-middle">{{ $loop->iteration }}</td>
                    <td class="align-middle">{{ $kamar->no_kamar }}</td>
                    <td class="align-middle">{{ $kamar->tipeKamar->tipe_kamar }}</td>
                    <td class="align-middle">
                        <a href="javascript:void(0);" class="btn btn-secondary btn-sm btn-img-kamar" data-image="{{ asset('storage/img/img-kamar/'.$kamar->gambar_kamar) }}">
                            <i class="fas fa-image"></i>
                            Lihat Gambar
                        </a>
                    </td>
                    <td class="align-middle">Rp . {{ number_format($kamar->harga_kamar,0,',','.') }}/malam</td>
                    <td class="align-middle">
                        <a href="{{ route('admin.data-kamar.show', $kamar->id) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-info-circle"></i>
                            Detail
                        </a>
                        <a href="{{ route('admin.data-kamar.edit', $kamar->id) }}" class="btn btn-success btn-sm">
                            <i class="fas fa-edit"></i>
                            Edit
                        </a>
                        <a href="#" class="btn btn-danger btn-sm btn-delete-data" data-id="{{ $kamar->id }}">
                            <i class="fas fa-trash"></i>
                            Delete
                        </a>
                        <form id="delete-data-{{ $kamar->id }}" action="{{ route('admin.data-kamar.destroy', $kamar->id) }}" method="POST" class="d-none">
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

        $(".btn-img-kamar").click(function(e){
            e.preventDefault();

            let data_image = $(this).data('image');

            $("#img-kamar").attr('src', data_image);
            $("#modal-show-image-kamar").modal('show');
        });
    });
</script>
@endsection