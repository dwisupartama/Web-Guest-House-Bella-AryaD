@extends('landing/layout/master')

@section('title', 'Booking List')

@section('content')
@if (\Session::has('error'))
    <script type="text/javascript">
    Swal.fire({
        icon: "error",
        title: "Failed",
        html: "{!! Session::get('error') !!}",
        confirmButtonColor: '#3085d6',
    });
    </script>
@endif
@if (\Session::has('success'))
    <script type="text/javascript">
        Swal.fire({
            icon: "success",
            title: "Successful",
            text: "{!! \Session::get('success') !!}",
            confirmButtonColor: '#3085d6',
        });
    </script>
@endif
<div class="container px-5 mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="bi bi-person"></i>&nbsp;&nbsp;Profile Setting
                </div>
                <div class="card-body">
                    <form action="{{ route('landing.user.profileSetting.update') }}" method="POST">
                        @csrf
                        <div class="col-lg-12 mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="nama" value="{{ auth()->guard('web')->user()->nama }}" placeholder="Enter your full name...">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ auth()->guard('web')->user()->email }}" placeholder="Enter your email address...">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label class="form-label">Country of Origin</label>
                            <input type="text" class="form-control @error('asal_negara') is-invalid @enderror" name="asal_negara" value="{{ auth()->guard('web')->user()->asal_negara }}" placeholder="Enter your country...">
                            @error('asal_negara')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="col-lg-12 mb-4">
                            <label class="form-label">Phone Number</label>
                            <input type="text" class="form-control @error('no_telp') is-invalid @enderror" name="no_telp" value="{{ auth()->guard('web')->user()->no_telp }}" placeholder="Enter your phone number...">
                            @error('no_telp')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-box-arrow-down"></i>&nbsp;&nbsp;Update Profile
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="bi bi-arrow-clockwise"></i>&nbsp;&nbsp;Reset Password
                </div>
                <div class="card-body">
                    <form action="{{ route('landing.user.profileSetting.reset') }}" method="POST">
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
                                <i class="bi bi-arrow-clockwise"></i>&nbsp;&nbsp;Reset Password
                            </button>
                        </div>
                    </form>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
