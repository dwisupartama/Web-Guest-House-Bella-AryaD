@extends('admin/layout/master')

@section('title', 'Edit Data Admin')

@section('content')
<div class="alert alert-primary col-lg-7 mb-4" role="alert">
    Perbaharui data admin agar website mendapatkan data admin terbaru untuk disimpan.
</div>
<div class="card col-lg-7 mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Edit Data Admin
    </div>
    <div class="card-body">
        <form action="{{ route('admin.data-admin.store') }}" method="POST">
            @method('PATCH')
            @csrf
            <div class="mb-3">
                <label class="form-label">Nama Admin</label>
                <input type="text" class="form-control @error('nama_admin') is-invalid @enderror" value="{{ $data_admin->nama_admin }}" name="nama_admin" placeholder="Masukkan nama admin...">
                @error('nama_admin')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" class="form-control @error('username') is-invalid @enderror" value="{{ $data_admin->username }}" name="username" placeholder="Masukkan username admin...">
                @error('username')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Alamat Admin</label>
                <textarea class="form-control @error('alamat_admin') is-invalid @enderror" rows="3" placeholder="Masukan alamat admin..." name="alamat_admin">{{ $data_admin->alamat_admin }}</textarea>
                @error('alamat_admin')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">No. Telp Admin</label>
                <input type="text" class="form-control @error('no_telp_admin') is-invalid @enderror" value="{{ $data_admin->no_telp }}" name="no_telp_admin" placeholder="Masukkan no. telp admin...">
                @error('no_telp_admin')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i>&nbsp;&nbsp;Simpan Data</button>
        </form>
    </div>
</div>
@endsection
