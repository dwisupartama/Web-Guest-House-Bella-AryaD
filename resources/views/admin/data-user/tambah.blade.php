@extends('admin/layout/master')

@section('title', 'Tambah Data User')

@section('content')
<div class="alert alert-primary col-lg-7 mb-4" role="alert">
    Tambahkan user baru untuk mendaftarkan akun pengguna agar dapat digunakan untuk melakukan transaksi.
</div>
<div class="card col-lg-7 mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Tambah User
    </div>
    <div class="card-body">
        <form action="{{ route('admin.data-user.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nama User</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" name="nama" placeholder="Masukkan nama user...">
                @error('nama')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" name="email" placeholder="Masukkan email user...">
                @error('email')
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
                <label class="form-label">Asal Negara</label>
                <input type="text" class="form-control @error('asal_negara') is-invalid @enderror" value="{{ old('asal_negara') }}" name="asal_negara" placeholder="Masukkan asal negara user...">
                @error('asal_negara')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">No. Telp</label>
                <input type="text" class="form-control @error('no_telp') is-invalid @enderror" value="{{ old('no_telp') }}" name="no_telp" placeholder="Masukkan no. telp user...">
                @error('no_telp')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>&nbsp;&nbsp;Simpan Data</button>
            <a href="{{ route('admin.data-user.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
