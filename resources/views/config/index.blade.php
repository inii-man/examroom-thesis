@extends('layouts.app')

@section('page-style')
    <style></style>
@endsection

@section('meta-header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <div class="row mb-4">
        <div class="col-md-10 col-12">
            <h4 class="fw-bold mb-0"><span class="text-muted fw-light">Configuration /</span> App Configuration</h4>
        </div>
    </div>

    <form class="container-xxl flex-grow-1 container-p-y default-form" action="{{ route('config.store') }}" id="formConfig"
        function-callback="afterAction">
        @csrf
        <div class="row row-cols-1 row-cols-md-2 g-6 mb-12">
            {{-- App Logo --}}
            <div class="col">
                <div class="card h-100">
                    <div class="card-body text-center form-group">
                        <img src="{{ app_config('app_logo') }}" alt="App Logo" class="img-fluid mb-3" id="appLogo"
                            style="max-width:150px">
                        <h5>App Logo</h5>
                        <p>
                            The logo of the application.
                        </p>
                        <div class="button-wrapper">
                            <label for="upload-app-logo" class="btn btn-primary me-3 mb-4" tabindex="0">
                                <span class="d-none d-sm-block">Upload new photo</span>
                                <i class="ti ti-upload d-block d-sm-none"></i>
                                <input type="file" id="upload-app-logo" class="app-logo-upload" hidden name="app_logo"
                                    accept="image/png, image/jpeg, image/svg+xml" />
                            </label>
                            <button type="button" class="btn btn-label-secondary app-logo-reset mb-4">
                                <i class="ti ti-refresh-dot d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Reset</span>
                            </button>

                            <div>Allowed JPG, SVG or PNG. Max size of 1MB</div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Sidebar Logo --}}
            <div class="col">
                <div class="card h-100">
                    <div class="card-body text-center form-group">
                        <img src="{{ app_config('sidebar_logo') }}" alt="App Logo" class="img-fluid mb-3"
                            style="max-width:150px" id="sidebarLogo">
                        <h5>Sidebar Logo</h5>
                        <p>
                            The logo that appears on the sidebar.
                        </p>
                        <div class="button-wrapper">
                            <label for="upload-sidebar-logo" class="btn btn-primary me-3 mb-4" tabindex="0">
                                <span class="d-none d-sm-block">Upload new photo</span>
                                <i class="ti ti-upload d-block d-sm-none"></i>
                                <input type="file" id="upload-sidebar-logo" class="sidebar-logo-upload" hidden
                                    name="sidebar_logo" accept="image/png, image/jpeg, image/svg+xml" />
                            </label>
                            <button type="button" class="btn btn-label-secondary sidebar-logo-reset mb-4">
                                <i class="ti ti-refresh-dot d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Reset</span>
                            </button>

                            <div>Allowed JPG, SVG or PNG. Max size of 1MB</div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Name --}}
            <div class="col">
                <div class="card h-100">
                    <div class="card-body text-center form-group">
                        <input type="text" class="form-control mb-3" value="{{ app_config('app_name') }}"
                            name="app_name">
                        <div class="invalid-feedback text-start"></div>
                        <h5>App Name</h5>
                        <p>
                            The name of the application.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <div class="card-body text-center form-group">
                        <input type="text" class="form-control mb-3" value="{{ app_config('sidebar_name') }}"
                            name="sidebar_name">
                        <div class="invalid-feedback text-start"></div>
                        <h5>Sidebar Name</h5>
                        <p>
                            The title that appears on the sidebar.
                        </p>
                    </div>
                </div>
            </div>
            {{-- Primary Color --}}
            <div class="col">
                <div class="card h-100">
                    <div class="card-body text-center form-group">
                        <input class="form-control mb-3" type="color" value="{{ app_config('primary_hex') }}"
                            name="primary_hex">
                        <div class="mb-4">
                            <button type="button" class="btn btn-primary me-2">Primary</button>
                            <button type="button" class="btn btn-outline-primary me-2">Outline</button>
                            <button type="button" class="btn alert-primary me-2">Label</button>
                        </div>
                        <h5>App Colors : <span class="badge bg-primary">{{ app_config('primary_hex') }}</span></h5>
                        <p>
                            The colors of the application.
                        </p>
                    </div>
                </div>
            </div>
            {{-- Primary Color --}}
            <div class="col">
                <div class="card h-100">
                    <div class="card-body text-center form-group">
                        <div class="form-check form-check-inline mt-4">
                            <input class="form-check-input" type="radio" name="app_home" id="radioDashboard"
                                value="Dashboard" @if (app_config('app_home') == 'Dashboard') checked @endif />
                            <label class="form-check-label" for="radioDashboard">Dashboard</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="app_home" id="radioAdmin"
                                value="Landing Page" @if (app_config('app_home') == 'Landing Page') checked @endif />
                            <label class="form-check-label" for="radioAdmin">Landing Page</label>
                        </div>
                        <h5>App Home</h5>
                        <p>
                            Whether the home page of app goes to dashboard or admin page.
                        </p>
                    </div>
                </div>
            </div>
            {{-- login background --}}
            <div class="col">
                <div class="card h-100">
                    <div class="card-body text-center form-group">
                        <img src="{{ app_config('login_bg') }}" alt="Login Background" class="img-fluid mb-3"
                            style="max-width:150px" id="loginBg">
                        <h5>Login Background</h5>
                        <div class="row row-cols-2 g-4 mb-4 mx-4">
                            <div class="col-md mb-md-0 mb-5 d-flex justify-content-center">
                                <div class="form-check custom-option custom-option-image custom-option-image-radio"
                                    style="height: 100px; width: 100px">
                                    <label class="form-check-label custom-option-content" for="fitIimg">
                                        <span class="custom-option-body">
                                            <img src="/assets/img/backgrounds/4.jpg" alt="radioImg" class="my-4" />
                                        </span>
                                    </label>
                                    <input name="login_bg_style" class="form-check-input" type="radio"
                                        value="height: auto; width: 100%;" id="fitIimg"
                                        @if (app_config('login_bg_style') == 'height: auto; width: 100%;') checked @endif />
                                </div>
                            </div>
                            <div class="col-md mb-md-0 mb-5 d-flex justify-content-center">
                                <div class="form-check custom-option custom-option-image custom-option-image-radio"
                                    style="height: 100px; width: 100px">
                                    <label class="form-check-label custom-option-content" for="fillImg">
                                        <span class="custom-option-body">
                                            <img src="/assets/img/backgrounds/headphones.png" style="object-fit: fill;"
                                                alt="radioImg" />
                                        </span>
                                    </label>
                                    <input name="login_bg_style" class="form-check-input" type="radio"
                                        value="object-fit: fill; height: 100vh; z-index: -1" id="fillImg"
                                        @if (app_config('login_bg_style') == 'object-fit: fill; height: 100vh; z-index: -1') checked @endif />
                                </div>
                            </div>
                            <div class="col fw-bold align-self-center">
                                Fit
                            </div>
                            <div class="col fw-bold text-center">
                                Fill
                            </div>
                        </div>
                        <p>
                            The background image of the login page.
                        </p>
                        <div class="button-wrapper">
                            <label for="upload-login-bg" class="btn btn-primary me-3 mb-4" tabindex="0">
                                <span class="d-none d-sm-block">Upload new photo</span>
                                <i class="ti ti-upload d-block d-sm-none"></i>
                                <input type="file" id="upload-login-bg" class="login-bg-upload" hidden
                                    name="login_bg" accept="image/png, image/jpeg, image/svg+xml" />
                            </label>
                            <button type="button" class="btn btn-label-secondary login-bg-reset mb-4">
                                <i class="ti ti-refresh-dot d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Reset</span>
                            </button>

                            <div>Allowed JPG, SVG or PNG. Max size of 1MB</div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Reset --}}
            <div class="col">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <div class="form-check form-check-inline mt-4">
                            <input class="form-check-input" type="radio" name="show_dummy" id="radioTrue"
                                value="true" @if (app_config('show_dummy') == 'true') checked @endif />
                            <label class="form-check-label" for="radioTrue">Yes, Show it!</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="show_dummy" id="radioFalse"
                                value="false" @if (app_config('show_dummy') == 'false') checked @endif />
                            <label class="form-check-label" for="radioFalse">No. Hide it!</label>
                        </div>
                        <h5>Show Dummy Masters</h5>
                        <p>
                            Whether to show dummy masters like ship, branch, and light house or not. <b>Super Admin are not
                                affected by this setting.</b>
                        </p>
                    </div>
                    <hr>
                    <div class="card-body d-flex justify-content-center h-100">
                        <button type="button" class="btn btn-danger align-self-center" id="btnReset">
                            Reset to Default Template Settings
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center">
            <button type="button" class="btn btn-primary me-2 submit" id="btnSave" disabled>Save Changes</button>
            <button type="button" class="btn btn-outline-danger" onclick="location.reload()">Reset</button>
        </div>
    </form>
@endsection

@section('page-js')
    <script>
        let appLogo = document.getElementById('appLogo');
        const fileInputApp = document.querySelector('.app-logo-upload'),
            resetFileInputApp = document.querySelector('.app-logo-reset');
        if (appLogo) {
            const resetImage = appLogo.src;
            fileInputApp.onchange = () => {
                if (fileInputApp.files[0]) {
                    if (fileInputApp.files[0].size > 1024 * 1024) {
                        fileInputApp.value = '';
                        showSweetAlert({
                            title: 'Error!',
                            text: 'The file size is too large. Max size is 1MB.',
                            icon: 'error',
                            showConfirmButton: true
                        });
                        return;
                    }
                }
                if (fileInputApp.files[0]) {
                    appLogo.src = window.URL.createObjectURL(fileInputApp.files[0]);
                }
            };
            resetFileInputApp.onclick = () => {
                fileInputApp.value = '';
                appLogo.src = resetImage;
            };
        }

        let sidebarLogo = document.getElementById('sidebarLogo');
        const fileInputSidebar = document.querySelector('.sidebar-logo-upload'),
            resetFileInputSidebar = document.querySelector('.sidebar-logo-reset');
        if (sidebarLogo) {
            const resetImage = sidebarLogo.src;
            fileInputSidebar.onchange = () => {
                if (fileInputSidebar.files[0]) {
                    if (fileInputSidebar.files[0].size > 1024 * 1024) {
                        fileInputSidebar.value = '';
                        showSweetAlert({
                            title: 'Error!',
                            text: 'The file size is too large. Max size is 1MB.',
                            icon: 'error',
                            showConfirmButton: true
                        });
                        return;
                    }
                }
                if (fileInputSidebar.files[0]) {
                    sidebarLogo.src = window.URL.createObjectURL(fileInputSidebar.files[0]);
                }
            };
            resetFileInputSidebar.onclick = () => {
                fileInputSidebar.value = '';
                sidebarLogo.src = resetImage;
            };
        }

        let loginBg = document.getElementById('loginBg');
        const fileInputLogin = document.querySelector('.login-bg-upload'),
            resetFileInputLogin = document.querySelector('.login-bg-reset');
        if (loginBg) {
            const resetImage = loginBg.src;
            fileInputLogin.onchange = () => {
                if (fileInputLogin.files[0]) {
                    if (fileInputLogin.files[0].size > 1024 * 1024) {
                        fileInputLogin.value = '';
                        showSweetAlert({
                            title: 'Error!',
                            text: 'The file size is too large. Max size is 1MB.',
                            icon: 'error',
                            showConfirmButton: true
                        });
                        return;
                    }
                }
                if (fileInputLogin.files[0]) {
                    loginBg.src = window.URL.createObjectURL(fileInputLogin.files[0]);
                }
            };
            resetFileInputLogin.onclick = () => {
                fileInputLogin.value = '';
                loginBg.src = resetImage;
            };
        }

        $('#btnSave').on('click', function(e) {
            e.preventDefault();
            sweetAlertConfirm({
                title: 'Are you sure?',
                text: 'You are about to change config of this application!',
                icon: 'warning',
                confirmButtonText: 'Yes, I do!',
                cancelButtonText: 'No, cancel!',
            }, function() {
                $('#formConfig').submit();
            });
        });

        function afterAction() {
            setTimeout(() => {
                location.reload();
            }, 1000);
        }

        $('#btnReset').on('click', function() {
            sweetAlertConfirm({
                title: 'Are you sure?',
                text: 'You are about to reset the configuration of this application!',
                icon: 'warning',
                confirmButtonText: 'Yes, I do!',
                cancelButtonText: 'No, cancel!',
            }, function() {
                $.ajax({
                    url: '{{ route('config.reset') }}',
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        showSweetAlert({
                            title: response?.data?.title ?? 'Success!',
                            text: response.message,
                            icon: response?.data?.icon ?? 'success',
                            showConfirmButton: response?.data?.showConfirmButton
                        }).then((result) => {
                            location.reload();
                        });
                    },
                    error: function(response) {
                        showSweetAlert({
                            title: response?.data?.title ?? 'Error!',
                            text: response.responseJSON.message,
                            icon: response?.data?.icon ?? 'error',
                            showConfirmButton: response?.data?.showConfirmButton
                        });
                    }
                });
            });
        });
    </script>
@endsection
