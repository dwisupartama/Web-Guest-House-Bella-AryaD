@extends('admin/layout/master')

@section('title', 'Edit Data Konten')

@section('style')
<style>
    .ck-editor__editable_inline {
        min-height: 200px;
    }
</style>    
@endsection

@section('content')
<div class="alert alert-primary col-lg-7 mb-4" role="alert">
    Perbaharui data konten agar website mendapatkan data konten terbaru untuk ditampilkan.
</div>
<div class="card col-lg-7 mb-4">
    <div class="card-header">
        <i class="fas fa-edit me-1"></i>
        Edit Konten
    </div>
    <div class="card-body">
        <form action="{{ route('admin.data-konten.update', $data_konten->id) }}" method="POST">
            @method('PATCH')
            @csrf
            <div class="mb-3">
                <label class="form-label">Judul Konten</label>
                <input type="text" class="form-control @error('judul_konten') is-invalid @enderror" value="{{ $data_konten->judul_konten }}" name="judul_konten" placeholder="Masukkan judul konten...">
                @error('judul_konten')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Deskripsi Konten</label>
                <textarea class="form-control editor @error('deskripsi_konten') is-invalid @enderror" placeholder="Masukan deskripsi konten..." name="deskripsi_konten">{{ $data_konten->deskripsi_konten }}</textarea>
                @error('deskripsi_konten')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i>&nbsp;&nbsp;Perbaharui Data</button>
            <a href="{{ route('admin.data-konten.index') }}" class="btn btn-secondary">Kembali</a>
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
@endsection