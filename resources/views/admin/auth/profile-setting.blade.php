@extends('admin/layout/master')

@section('title', 'Profile Setting')

@section('content')
<div class="alert alert-primary mb-4" role="alert">
    Profile Setting adalah tempat untuk mengatur deskripsi atau data dari anda
</div>

@if (\Session::has('success'))
<script type="text/javascript">
Swal.fire({
    icon: "success",
    title: "Berhasil",
    text: "{!! \Session::get('success') !!}",
    confirmButtonColor: '#3085d6',
});
</script>
@endif

@if (\Session::has('error'))
<script type="text/javascript">
Swal.fire({
    icon: "error",
    title: "Gagal",
    text: "{!! \Session::get('error') !!}",
    confirmButtonColor: '#3085d6',
});
</script>
@endif

<div class="row">
    <div class="col-8">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-user"></i>&nbsp;&nbsp;Profile Setting
            </div>
            <div class="card-body">
                <form action="{{ route('admin.profileSetting.update') }}" method="POST">
                    @csrf
                    <div class="col-lg-12 mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control @error('nama_admin') is-invalid @enderror" name="nama_admin" value="{{ auth()->guard('admin')->user()->nama_admin }}">
                        @error('nama_admin')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="col-lg-12 mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ auth()->guard('admin')->user()->username }}">
                        @error('username')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="col-lg-12 mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea class="form-control @error('alamat_admin') is-invalid @enderror" name="alamat_admin" rows="3">{{ auth()->guard('admin')->user()->alamat_admin }}</textarea>
                        @error('alamat_admin')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="col-lg-12 mb-4">
                        <label class="form-label">No. Telp</label>
                        <input type="text" class="form-control @error('no_telp') is-invalid @enderror" name="no_telp" value="{{ auth()->guard('admin')->user()->no_telp }}">
                        @error('no_telp')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-user-edit"></i>&nbsp;&nbsp;Update Profile
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-sync"></i>&nbsp;&nbsp;Reset Password
            </div>
            <div class="card-body">
                <form action="{{ route('admin.profileSetting.resetPassword') }}" method="POST">
                    @csrf
                    <div class="col-lg-12 mb-2">
                        <label class="form-label">Old Password</label>
                        <input type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" placeholder="Enter your old password...">
                        @error('old_password')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="col-lg-12 mb-2">
                        <label class="form-label">New Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter new password...">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="col-lg-12 mb-3">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="password_confirmation" placeholder="Enter confirm new password...">
                    </div>
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-sync"></i>&nbsp;&nbsp;Reset Password
                        </button>
                    </div>
                </form>                    
            </div>
        </div>
    </div>
</div>
@endsection