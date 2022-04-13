@extends('admin/layout/master')

@section('title', 'Tambah Data Admin')

@section('content')
<div class="alert alert-primary col-lg-7 mb-4" role="alert">
    Tambahkan admin baru untuk mendaftarkan akun kepada seseorang yang ingin mengelola admin website.
</div>
<div class="card col-lg-7 mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Tambah Admin
    </div>
    <div class="card-body">
        <form action="{{ route('admin.data-admin.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nama Admin</label>
                <input type="text" class="form-control @error('nama_admin') is-invalid @enderror" value="{{ old('nama_admin') }}" name="nama_admin" placeholder="Masukkan nama admin...">
                @error('nama_admin')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Hak Akses</label>
                <select class="form-select" name="hak_akses" aria-label="Default select example">
                    <option value="">Pilih Hak Akses</option>
                    <option value="Admin">Admin</option>
                    <option value="Karyawan">Karyawan</option>
                </select>
                @error('hak_akses')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" name="username" placeholder="Masukkan username admin...">
                @error('username')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" name="password" placeholder="Masukkan password admin...">
                @error('password')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Konfirmasi Password</label>
                <input type="password" class="form-control" name="password_confirmation"
                    placeholder="Masukkan konfirmasi password admin...">
            </div>
            <div class="mb-3">
                <label class="form-label">Alamat Admin</label>
                <textarea class="form-control @error('alamat_admin') is-invalid @enderror" rows="3" placeholder="Masukan alamat admin..." name="alamat_admin">{{ old('alamat_admin') }}</textarea>
                @error('alamat_admin')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">No. Telp Admin</label>
                <input type="text" class="form-control @error('no_telp_admin') is-invalid @enderror" value="{{ old('no_telp_admin') }}" name="no_telp_admin" placeholder="Masukkan no. telp admin...">
                @error('no_telp_admin')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>&nbsp;&nbsp;Simpan Data</button>
            <a href="{{ route('admin.data-admin.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
