@extends('admin/layout/master')

@section('title', 'Edit Data Customer')

@section('content')
<div class="alert alert-primary col-lg-7 mb-4" role="alert">
    Perbaharui data customer agar website mendapatkan data customer terbaru untuk disimpan.
</div>
<div class="card col-lg-7 mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Edit Data Customer
    </div>
    <div class="card-body">
        <form action="{{ route('admin.data-customer.update', $data_user->id) }}" method="POST">
            @method('PATCH')
            @csrf
            <div class="mb-3">
                <label class="form-label">Nama Customer</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" value="{{ $data_user->nama }}" name="nama" placeholder="Masukkan nama customer...">
                @error('nama')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{ $data_user->email }}" name="email" placeholder="Masukkan email customer...">
                @error('email')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Asal Negara</label>
                <input type="text" class="form-control @error('asal_negara') is-invalid @enderror" value="{{ $data_user->asal_negara }}" name="asal_negara" placeholder="Masukkan asal negara customer...">
                @error('asal_negara')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">No. Telp</label>
                <input type="text" class="form-control @error('no_telp') is-invalid @enderror" value="{{ $data_user->no_telp }}" name="no_telp" placeholder="Masukkan no. telp customer...">
                @error('no_telp')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i>&nbsp;&nbsp;Perbaharui Data</button>
            <a href="{{ route('admin.data-customer.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
