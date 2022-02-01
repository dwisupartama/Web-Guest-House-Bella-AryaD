@extends('admin/layout/master')

@section('title', 'Detail Kamar')

@section('content')
<div class="card col-lg-7 mb-4">
    <div class="card-header">
        <i class="fas fa-info-circle me-1"></i>
        Detail Kamar
    </div>
    <div class="card-body">
        <div class="row g-3 align-items-center mb-3">
            <div class="col-lg-6">
                <label class="form-label fw-bold">No. Kamar</label>
                <h3 style="margin-top: -8px" class="fw-light">{{ $data_kamar->no_kamar }}</h3>
            </div>
            <div class="col-lg-6">
                <label class="form-label fw-bold">Tipe Kamar</label>
                <h3 style="margin-top: -8px" class="fw-light">{{ $data_kamar->tipeKamar->tipe_kamar }}</h3>
            </div>
        </div>
        <div class="row g-3 mb-3">
            <div class="col-lg-6">
                <label class="form-label fw-bold">Harga Kamar</label>
                <h3 style="margin-top: -8px" class="fw-light">Rp . {{ number_format($data_kamar->harga_kamar,0,',','.') }}<span class="fw-light">/malam</span></h3>
            </div>
            <div class="col-lg-6">
                <label class="form-label fw-bold">Gambar Kamar</label>
                <div class="col-lg-12">
                    <img src="{{ asset('storage/img/img-kamar/'.$data_kamar->gambar_kamar) }}" class="img-thumbnail" alt="...">
                </div>
            </div>
        </div>
        <div class="mb-1">
            <label class="form-label fw-bold">Deskipsi Kamar</label>
            <div class="fw-light">
                {!! $data_kamar->deskripsi_kamar !!}
            </div>
        </div>
        <a href="{{ route('admin.data-kamar.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection