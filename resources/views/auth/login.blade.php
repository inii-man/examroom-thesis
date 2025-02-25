@extends('layouts.app')

@section('page-style')
    <link rel="stylesheet" href="{{ url('assets/vendor/libs/@form-validation/form-validation.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/vendor/css/pages/page-auth.css') }}" />
@endsection

@section('content')
    <div class="authentication-wrapper authentication-cover">
        <div class="authentication-inner row m-0">
            <!-- /Left Text -->
            <div class="d-none d-lg-flex col-lg-8 p-0">
                <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center"
                    style="object-fit: fill; height: 100vh; z-index: -2">
                    <img src="{{ app_config('login_bg') }}" alt="auth-login-cover"
                        style="{{ app_config('login_bg_style') }}" />
                </div>
            </div>
            <!-- /Left Text -->

            <!-- Login -->
            <div class="d-flex col-12 col-lg-4 align-items-center authentication-bg p-sm-12 p-6">
                <div class="w-px-400 mx-auto mt-12 pt-5">
                    <h4 class="mb-1">Welcome to {{ app_config('app_name') }}! 👋</h4>
                    <p class="mb-6">Please sign-in to your account and start the adventure</p>

                    <form id="formAuthentication" class="mb-6" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email"
                                placeholder="Enter your email" value="{{ old('email') }}" autofocus />
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-6 form-password-toggle">
                            <label class="form-label" for="password">Password</label>
                            <div class="input-group input-group-merge">
                                <input type="password" id="password" class="form-control" name="password"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="password" />
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                            </div>
                        </div>
                        <div class="my-8">
                            <div class="d-flex justify-content-between">
                                <div class="form-check mb-0 ms-2">
                                    <input class="form-check-input" type="checkbox" id="remember-me" name="remember" />
                                    <label class="form-check-label" for="remember-me"> Remember Me </label>
                                </div>
                                @if (Route::has('password.request'))
                                    <a class="text-primary" href="{{ route('password.request') }}">
                                        <p class="mb-0">Forgot Password?</p>
                                    </a>
                                @endif
                            </div>
                        </div>
                        <button id="btnLogin" class="btn btn-primary d-grid w-100">Sign in</button>
                    </form>

                    <p class="text-center">
                        <span>New on our platform?</span>
                        {{-- <a href="auth-register-cover.html"> --}}
                        <a class="text-primary" href="#">
                            <span>Create an account</span>
                        </a>
                    </p>

                    <div class="divider my-6">
                        <div class="divider-text">or</div>
                    </div>

                    <div class="d-flex justify-content-center">
                        <a href="javascript:;" class="btn btn-sm btn-icon rounded-pill btn-text-facebook me-1_5">
                            <i class="tf-icons ti ti-brand-facebook-filled"></i>
                        </a>

                        <a href="javascript:;" class="btn btn-sm btn-icon rounded-pill btn-text-twitter me-1_5">
                            <i class="tf-icons ti ti-brand-twitter-filled"></i>
                        </a>

                        <a href="javascript:;" class="btn btn-sm btn-icon rounded-pill btn-text-github me-1_5">
                            <i class="tf-icons ti ti-brand-github-filled"></i>
                        </a>

                        <a href="javascript:;" class="btn btn-sm btn-icon rounded-pill btn-text-google-plus">
                            <i class="tf-icons ti ti-brand-google-filled"></i>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /Login -->
        </div>
    </div>
@endsection

@section('page-js')
    <script src="{{ url('assets/vendor/libs/@form-validation/popular.js') }}"></script>
    <script src="{{ url('assets/vendor/libs/@form-validation/bootstrap5.js') }}"></script>
    <script src="{{ url('assets/vendor/libs/@form-validation/auto-focus.js') }}"></script>
    <script src="{{ url('assets/js/pages-auth.js') }}"></script>

    <script>
        $(document).on('keydown', function(e) {
            if (e.keyCode === 13) {
                $('#btnLogin').click();
            }
        });
    </script>
@endsection
