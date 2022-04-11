@extends('admin/layout/master')

@section('title', 'Edit Data Kamar')

@section('style')
<style>
    .ck-editor__editable_inline {
        min-height: 200px;
    }
</style>    
@endsection

@section('content')
<div class="alert alert-primary col-lg-7 mb-4" role="alert">
    Perbaharui data kamar agar website mendapatkan data kamar terbaru untuk disimpan.
</div>
<div class="card col-lg-7 mb-4">
    <div class="card-header">
        <i class="fas fa-edit me-1"></i>
        Edit Kamar
    </div>
    <div class="card-body">
        <form action="{{ route('admin.data-kamar.update', $data_kamar->id) }}" enctype="multipart/form-data" method="POST">
            @method('PATCH')
            @csrf
            <div class="mb-3">
                <label class="form-label">No. Kamar</label>
                <input type="text" class="form-control @error('no_kamar') is-invalid @enderror" value="{{ $data_kamar->no_kamar }}" name="no_kamar" placeholder="Masukkan no. kamar...">
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
                        <option @if($data_kamar->id_tipe_kamar == $tipe_kamar->id) selected @endif value="{{ $tipe_kamar->id }}">{{ $tipe_kamar->tipe_kamar }}</option>
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
                  </div>
                @error('gambar_kamar')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="mb-3" id="preview-img-kamar">
                <div class="col-lg-4">
                    <img src="{{ asset('storage/img/img-kamar/'.$data_kamar->gambar_kamar) }}" class="img-thumbnail" alt="...">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Harga Kamar</label>
                <div class="input-group mb-3">
                    <span class="input-group-text">Rp. </span>
                    <input type="number" class="form-control @error('harga_kamar') is-invalid @enderror" value="{{ $data_kamar->harga_kamar }}" name="harga_kamar" placeholder="Masukkan harga kamar...">
                    <span class="input-group-text">/malam</span>
                </div>
                @error('harga_kamar')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Deskripsi Singkat</label>
                <textarea class="form-control @error('deskripsi_singkat') is-invalid @enderror" placeholder="Masukan deskripsi singkat kamar..." name="deskripsi_singkat">{{ $data_kamar->deskripsi_singkat }}</textarea>
                @error('deskripsi_singkat')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Deskripsi Kamar</label>
                <textarea class="form-control editor @error('deskripsi_kamar') is-invalid @enderror" placeholder="Masukan deskripsi kamar..." name="deskripsi_kamar">{{ $data_kamar->deskripsi_kamar }}</textarea>
                @error('deskripsi_kamar')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i>&nbsp;&nbsp;Perbaharui Data</button>
            <a href="{{ route('admin.data-kamar.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
    ClassicEditor
            .create( document.querySelector( '.editor' ),{
                toolbar: {
                    items: [
                        'heading', '|',
                        'alignment', '|',
                        'bold', 'italic', 'strikethrough', 'underline', '|',
                        'link', '|',
                        'undo', 'redo'
                    ],
                    shouldNotGroupWhenFull: true
                }
            } )
            .then( editor => {
                    console.log( editor );
            } )
            .catch( error => {
                    console.error( error );
            } );
</script>
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