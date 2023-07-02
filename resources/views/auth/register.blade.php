@extends('layouts/blankLayout')

@section('title', 'Register Basic - Pages')

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection


@section('content')
<div class="container-xxxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">

        <!-- Register Card -->
        <div class="card">
            <div class="card-body">
            <div class="text-center">          
                <h4 class="mb-2">Jacinto Ignacio Market 🚀</h4>
                <p class="mb-4">Tenant Management System </p>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                
                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-start">{{ __('Name') }}</label>
                
                        <div class="col-md-12">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                
                    <div class="row mb-3">
                        <div class="col-md-12 text-start">
                            <label for="email" class="col-form-label">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                
                    </div>
                
                    <div class="row mb-3">
                        <label for="level" class="col-md-12 col-form-label text-md-start">{{ __('Level') }}</label>
                
                        <div class="col-md-12">
                            <select name="level" id="level" class="form-control" required>
                                <option value="" selected disabled>Select a role for user</option>
                                <option value="admin" class="form-control">Admin</option>
                                <option value="encoder" class="form-control">Encoder</option>
                                <option value="viewer" class="form-control">Viewer</option>
                            </select>
                        
                            @error('level')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                
                
                    <div class="row mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-start">{{ __('Password') }}</label>
                
                        <div class="col-md-12">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                
                    <div class="row mb-3">
                        <label for="password-confirm" class="col-md-12 col-form-label text-md-start">{{ __('Confirm Password') }}</label>
                
                        <div class="col-md-12">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>
                
                    <div class="row mb-0">
                        <div class="col-md-12 text-center d-grid">
                            <button type="submit" class="btn btn-primary btn-block">
                                {{ __('Create Account') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            </div>
        </div>
        </div>
        <!-- Register Card -->
    </div>
</div>

@endsection
