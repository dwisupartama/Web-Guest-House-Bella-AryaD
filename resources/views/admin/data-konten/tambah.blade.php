@extends('admin/layout/master')

@section('title', 'Tambah Data Konten')

@section('style')
<style>
    .ck-editor__editable_inline {
        min-height: 200px;
    }
</style>    
@endsection

@section('content')
<div class="alert alert-primary col-lg-7 mb-4" role="alert">
    Tambahkan konten baru untuk membuat konten baru yang terdapat pada artikel website.
</div>
<div class="card col-lg-7 mb-4">
    <div class="card-header">
        <i class="fas fa-plus me-1"></i>
        Tambah Konten
    </div>
    <div class="card-body">
        <form action="{{ route('admin.data-konten.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Judul Konten</label>
                <input type="text" class="form-control @error('judul_konten') is-invalid @enderror" value="{{ old('judul_konten') }}" name="judul_konten" placeholder="Masukkan judul konten...">
                @error('judul_konten')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Deskripsi Konten</label>
                <textarea class="form-control editor @error('deskripsi_konten') is-invalid @enderror" placeholder="Masukan deskripsi konten..." name="deskripsi_konten">{{ old('deskripsi_konten') }}</textarea>
                @error('deskripsi_konten')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>&nbsp;&nbsp;Simpan Data</button>
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