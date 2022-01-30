@extends('admin/layout/master')

@section('title', 'Tambah Data Kamar')

@section('content')
<div class="alert alert-primary col-lg-7 mb-4" role="alert">
    Tambahkan kamar baru untuk mendaftarkan kamar baru yang terdapat pada guest house.
</div>
<div class="card col-lg-7 mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Tambah Kamar
    </div>
    <div class="card-body">
        <form action="{{ route('admin.data-kamar.store') }}" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">No. Kamar</label>
                <input type="text" class="form-control @error('no_kamar') is-invalid @enderror" value="{{ old('no_kamar') }}" name="no_kamar" placeholder="Masukkan no. kamar...">
                @error('no_kamar')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Tipe Kamar</label>
                <select class="form-select" name="tipe_kamar" aria-label="Default select example">
                    <option>Pilih Tipe Kamar</option>
                    @foreach ($data_tipe_kamar as $tipe_kamar)
                        <option @if(old('tipe_kamar') == $tipe_kamar->id) selected @endif value="{{ $tipe_kamar->id }}">{{ $tipe_kamar->tipe_kamar }}</option>
                    @endforeach
                </select>
                @error('username')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="mb-1">
                <label class="form-label">Gambar Kamar</label>
                <div class="input-group mb-3">
                    <input type="file" class="form-control @error('gambar_kamar') is-invalid @enderror" id="input-img-kamar" name="gambar_kamar" accept="image/*">
                    <label class="input-group-text" for="input-img-kamar">Upload</label>
                  </div>
                @error('gambar_kamar')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="mb-3" style="display: none;" id="preview-img-kamar">
                <div class="col-lg-4">
                    <img src="" class="img-thumbnail" alt="...">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Harga Kamar</label>
                <div class="input-group mb-3">
                    <input type="number" class="form-control @error('harga_kamar') is-invalid @enderror" value="{{ old('harga_kamar') }}" name="harga_kamar" placeholder="Masukkan harga kamar...">
                    <span class="input-group-text">/malam</span>
                </div>
                @error('harga_kamar')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Deskripsi Kamar</label>
                <textarea class="form-control @error('deskripsi_kamar') is-invalid @enderror" rows="3" placeholder="Masukan deskripsi kamar..." name="deskripsi_kamar">{{ old('deskripsi_kamar') }}</textarea>
                @error('deskripsi_kamar')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>&nbsp;&nbsp;Simpan Data</button>
            <a href="{{ route('admin.data-kamar.index') }}" class="btn btn-secondary">Kembali</a>
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
                    $('#preview-img-kamar img').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#input-img-kamar").change(function() {
            readURL(this);
            $("#preview-img-kamar").show(0);
        });
    });
</script>
@endsection