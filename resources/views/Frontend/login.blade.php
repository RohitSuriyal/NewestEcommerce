@extends('layouts.website')

@push('styles')
<style>
    .login-left h2 {
        font-size: 2rem; /* adjust heading size */
    }

    .login-left p {
        font-size: 1rem; /* normal info text */
    }

    .form-label {
        font-size: 0.95rem; /* smaller label */
    }

    .form-control-lg {
        font-size: 1rem; /* input text size */
    }

    .btn-lg {
        font-size: 1rem; /* button font size */
    }

    .small {
        font-size: 0.85rem; /* fine print */
    }

    .fw-bold.text-primary {
        font-size: 0.95rem; /* create account link */
    }
</style>
@endpush

@section('content')
<div class="container-fluid" style="min-height: 100vh;">
    <div class="row h-100">
        {{-- Left Side --}}
        <div class="col-md-5 d-flex flex-column justify-content-center text-white p-5 login-left"
             style="background-color: #2874f0; min-height: 100vh;">
            <h2 class="fw-bold">Login</h2>
            <p class="mt-3">Get access to your Orders, Wishlist and Recommendations</p>
            <img src="{{ asset('images/login-side.png') }}" alt="login-info" class="img-fluid mt-4" style="max-width: 250px;">
        </div>
        
        {{-- Right Side --}}
        <div class="col-md-7 d-flex justify-content-center align-items-center">
            <div class="w-75">
                <form action="{{route('website.customerlogin')}}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="email" class="form-label">Enter Email/Mobile number</label>
                        <input type="text"
                               name="email"
                               id="email"
                               class="form-control form-control-lg @error('email') is-invalid @enderror"
                               placeholder="Enter your Email or Mobile"
                               value="{{ old('email') }}"
                               required autofocus
                               >
                        @error('email')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-warning btn-lg fw-bold text-white">Request OTP</button>
                    </div>
                </form>

                <p class="mt-3 small text-muted">
                    By continuing, you agree to Flipkart’s
                    <a href="#">Terms of Use</a> and
                    <a href="#">Privacy Policy</a>.
                </p>

                <div class="mt-4 text-center">
                    <a class="fw-bold text-primary">New to Wbsite? Create an account</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
