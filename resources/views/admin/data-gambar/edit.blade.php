@extends('admin/layout/master')

@section('title', 'Edit Data Gambar')

@section('style')
<style>
    .ck-editor__editable_inline {
        min-height: 200px;
    }
</style>    
@endsection

@section('content')
<div class="alert alert-primary col-lg-7 mb-4" role="alert">
    Perbaharui data gambar agar website mendapatkan data gambar terbaru untuk disimpan.
</div>
<div class="card col-lg-7 mb-4">
    <div class="card-header">
        <i class="fas fa-edit me-1"></i>
        Edit Gambar
    </div>
    <div class="card-body">
        <form action="{{ route('admin.data-gambar.update', $data_gambar->id) }}" enctype="multipart/form-data" method="POST">
            @method('PATCH')
            @csrf
            <div class="mb-1">
                <label class="form-label">Gambar Konten</label>
                <div class="input-group mb-3">
                    <input type="file" class="form-control @error('gambar_konten') is-invalid @enderror" id="input-img-gambar" name="gambar_konten" accept="image/*">
                    @error('gambar_konten')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>
            <div class="mb-3" id="preview-img-gambar">
                <div class="col-lg-4">
                    <img src="{{ asset('storage/img/img-konten/'.$data_gambar->link_gambar) }}" class="img-thumbnail" alt="...">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Nama Gambar</label>
                <input type="text" class="form-control @error('nama_gambar') is-invalid @enderror" value="{{ $data_gambar->nama_gambar }}" name="nama_gambar" placeholder="Masukkan nama gambar...">
                @error('nama_gambar')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Jenis Konten</label>
                <select class="form-select" name="konten" aria-label="Default select example">
                    <option>Pilih Konten</option>
                    @foreach ($data_konten as $konten)
                        <option @if($data_gambar->id_konten == $konten->id) selected @endif value="{{ $konten->id }}">{{ $konten->judul_konten }}</option>
                    @endforeach
                </select>
                @error('username')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Keterangan</label>
                <textarea class="form-control @error('keterangan') is-invalid @enderror" rows="3" placeholder="Masukan deskripsi gambar..." name="keterangan">{{ $data_gambar->keterangan }}</textarea>
                @error('keterangan')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i>&nbsp;&nbsp;Perbaharui Data</button>
            <a href="{{ route('admin.data-gambar.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function(){
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#preview-img-gambar img').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#input-img-gambar").change(function() {
            readURL(this);
            $("#preview-img-gambar").show(0);
        });
    });
</script>
@endsection