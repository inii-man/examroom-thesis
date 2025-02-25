<!doctype html>

<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr"
    data-theme="theme-default" data-assets-path="/assets/" data-template="vertical-menu-template-no-customizer"
    data-style="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <title>{{ app_config('app_name') }}</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ app_config('app_logo') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="/assets/vendor/fonts/google-fonts.css"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="/assets/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="/assets/vendor/fonts/tabler-icons.css" />
    <link rel="stylesheet" href="/assets/vendor/fonts/flag-icons.css" />

    <!-- Core CSS -->

    <link rel="stylesheet" href="/assets/vendor/css/rtl/core.css" />
    <link rel="stylesheet" href="/assets/vendor/css/rtl/theme-default.css" />

    <link rel="stylesheet" href="/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="/assets/vendor/libs/node-waves/node-waves.css" />

    <link rel="stylesheet" href="/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="/assets/vendor/libs/typeahead-js/typeahead.css" />

    @if(Route::currentRouteName() != 'login')
    <link rel="stylesheet" href="/assets/vendor/libs/apex-charts/apex-charts.css" />
    <link rel="stylesheet" href="/assets/vendor/libs/swiper/swiper.css" />
    <link rel="stylesheet" href="/assets/vendor/libs/select2/select2.css" />
    <link rel="stylesheet" href="/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
    <link rel="stylesheet" href="/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
    <link rel="stylesheet" href="/assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css" />
    <link rel="stylesheet" href="/assets/vendor/libs/sweetalert2/sweetalert2.css" />
    <link rel="stylesheet" href="/assets/vendor/libs/flatpickr/flatpickr.css" />    
    @endif


    <!-- Additional Vendors CSS -->
    {{-- Kalau mau tambah package disini --}}

    <!-- Page CSS -->
    <link rel="stylesheet" href="/assets/vendor/css/pages/cards-advance.css" />

    <!-- Helpers -->
    <script src="/assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="/assets/js/config.js"></script>
    @yield('page-style')
    @yield('meta-header')
    <style>
        /* customized */
        .bg-menu-theme.menu-vertical .menu-item.active>.menu-link:not(.menu-toggle) {
            /* background: {{ app_config('primary_color') }} !important; */
            background: {{ app_config('primary_color') }} !important;
            border: 1px solid {{ app_config('primary_color') }} !important;
            box-shadow: 0 0.125rem 0.375rem {{ app_config('primary_color_shadow') }} !important;
        }

        .text-primary {
            color: {{ app_config('primary_color') }} !important;
        }

        .bg-primary {
            background-color: {{ app_config('primary_color') }} !important;
        }

        .bg-primary-shadow {
            box-shadow: 0 0.125rem 0.375rem {{ app_config('primary_color_shadow') }} !important;
        }

        .bg-label-primary {
            background-color: {{ app_config('primary_color_label') }} !important;
            color: {{ app_config('primary_color') }} !important;
        }

        .btn-primary.btn[class*=btn-]:not([class*=btn-label-]):not([class*=btn-outline-]):not([class*=btn-text-]):not(.btn-icon):not(:disabled):not(.disabled) {
            box-shadow: 0 0.125rem 0.375rem 0 {{ app_config('primary_color_shadow') }};
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: {{ app_config('primary_color') }} !important;
            color: #fff !important;
        }

        .select2-container--default .select2-results__option--highlighted:not([aria-selected=true]) {
            background-color: {{ app_config('primary_color_label') }} !important;
            color: {{ app_config('primary_color') }} !important;
        }

        .dropdown-item.active {
            background-color: {{ app_config('primary_color_label') }} !important;
        }
        .dropdown-item.active>span {
            color: {{ app_config('primary_color') }} !important;
        }
        .dropdown-item.active>i {
            color: {{ app_config('primary_color') }} !important;
        }

        .app-brand-logo.demo {
            -ms-flex-align: center;
            align-items: center;
            -ms-flex-pack: center;
            justify-content: center;
            display: -ms-flexbox;
            display: flex;
            width: 35px;
            height: 40px;
        }
        
        .form-control:focus:not([disabled]) {
            border-color: {{ app_config('primary_color') }} !important;
        }
       
        a:hover {
            color: {{ app_config('primary_color_hover') }} !important;
        }

        /* nav-link.active */
        .nav-link {
            color: {{ app_config('primary_color') }} !important;
            border-color: {{ app_config('primary_color') }} !important;            
        }

        .nav-link:hover {
            color: {{ app_config('primary_color_hover') }} !important;
            background-color: {{ app_config('primary_color_label') }} !important;
        }

        .nav-link.active {
            color: #ffffff !important;
            box-shadow: 0 0.125rem 0.375rem {{ app_config('primary_color_shadow') }} !important;
            background-color: {{ app_config('primary_color') }} !important;

        }
        
        /* GENERATED BY BOOTSTRAP 5 COLOR THEME GENERATOR */
        /* https://bootstrapcolors.com */
        .btn-outline-primary {
            color: {{ app_config('primary_color') }} !important;
            border-color: {{ app_config('primary_color') }} !important;
        }

        .btn-outline-primary:hover {
            color: #fff !important;
            background-color: {{ app_config('primary_color') }} !important;
            border-color: {{ app_config('primary_color') }} !important;
        }

        .form-check-input:focus+.btn-outline-primary,
        .btn-outline-primary:focus {
            box-shadow: 0 0.125rem 0.375rem {{ app_config('primary_color_shadow') }} !important;
        }

        .form-check-input:checked {
            background-color: {{ app_config('primary_color') }} !important;
            border-color: {{ app_config('primary_color') }} !important;
            box-shadow: {{ app_config('primary_color_shadow') }} !important;
        }

        .form-check-input:checked+.btn-outline-primary,
        .form-check-input:active+.btn-outline-primary,
        .btn-outline-primary:active,
        .btn-outline-primary.active,
        .btn-outline-primary.dropdown-toggle.show {
            color: #fff;
            background-color: {{ app_config('primary_color') }} !important;
            border-color: {{ app_config('primary_color') }} !important;
        }

        .form-check-input:checked+.btn-outline-primary:focus,
        .form-check-input:active+.btn-outline-primary:focus,
        .btn-outline-primary:active:focus,
        .btn-outline-primary.active:focus,
        .btn-outline-primary.dropdown-toggle.show:focus {
            box-shadow: 0 0.125rem 0.375rem {{ app_config('primary_color_shadow') }} !important;
        }

        .btn-outline-primary:disabled,
        .btn-outline-primary.disabled {
            color: {{ app_config('primary_color') }} !important;
            background-color: transparent;
        }

        .alert-primary {
            color: {{ app_config('primary_color') }} !important;
            background-color: {{ app_config('primary_color_label') }} !important;
            border-color: {{ app_config('primary_color_label') }} !important;
        }

        .alert-primary .alert-link {
            text-decoration: underline;
        }

        .bg-primary {
            background-color: {{ app_config('primary_color') }} !important !important;
        }

        .text-primary {
            color: {{ app_config('primary_color') }} !important !important;
        }

        .border-primary {
            border-color: {{ app_config('primary_color') }} !important !important;
        }

        .link-primary {
            color: {{ app_config('primary_color') }} !important;
        }

        .link-primary:hover,
        .link-primary:focus {
            color: {{ app_config('primary_color') }} !important;
        }

        .btn-primary {
            color: #ffffff;
            background-color: {{ app_config('primary_color') }} !important;
            border-color: {{ app_config('primary_color') }} !important;
        }

        .btn-primary:hover {
            color: #ffffff;
            background-color: {{ app_config('primary_color_hover') }} !important;
            border-color: {{ app_config('primary_color') }} !important;
        }

        .form-check-input:focus+.btn-primary,
        .btn-primary:focus {
            color: #ffffff;
            background-color: {{ app_config('primary_color_hover') }} !important;
            border-color: {{ app_config('primary_color') }} !important;
            box-shadow: 0 0.125rem 0.375rem 0 {{ app_config('primary_color_shadow') }};
        }

        .form-check-input:checked+.btn-primary,
        .form-check-input:active+.btn-primary,
        .btn-primary:active,
        .btn-primary.active,
        .show>.btn-primary.dropdown-toggle {
            color: #ffffff;
            background-color: {{ app_config('primary_color') }} !important;
            border-color: {{ app_config('primary_color') }} !important;
        }

        .form-check-input:checked+.btn-primary:focus,
        .form-check-input:active+.btn-primary:focus,
        .btn-primary:active:focus,
        .btn-primary.active:focus,
        .show>.btn-primary.dropdown-toggle:focus {
            box-shadow: 0 0.125rem 0.375rem rgba(68, 94, 156, 0.5);
        }

        .btn-primary:disabled,
        .btn-primary.disabled {
            color: #ffffff;
            background-color: {{ app_config('primary_color') }} !important;
            border-color: {{ app_config('primary_color') }} !important;
        }

        /*# sourceMappingURL=style-2024-11-11-08-03-47-483_button.css.map */
    </style>
</head>

<body>
    {{-- if page login --}}
    @if(Route::currentRouteName() == 'login')
        @yield('content')
    @else
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            <!-- Menu -->
            @include('layouts.sidebar')
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">

                <!-- Navbar -->
                @include('layouts.navbar')
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">

                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        @yield('content')
                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    @include('layouts.footer')
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->

            </div>
            <!-- / Layout page -->

        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->
    @endif
    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script src="/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="/assets/vendor/libs/popper/popper.js"></script>
    <script src="/assets/vendor/js/bootstrap.js"></script>
    <script src="/assets/vendor/libs/node-waves/node-waves.js"></script>
    <script src="/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="/assets/vendor/libs/hammer/hammer.js"></script>
    <script src="/assets/vendor/libs/i18n/i18n.js"></script>
    <script src="/assets/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="/assets/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    @if(Route::currentRouteName() != 'login')
    <script src="/assets/vendor/libs/apex-charts/apexcharts.js"></script>
    <script src="/assets/vendor/libs/swiper/swiper.js"></script>
    <script src="/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
    <script src="/assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
    <script src="/assets/vendor/libs/select2/select2.js"></script>
    <script src="/assets/vendor/libs/block-ui/block-ui.js"></script>
    <script src="/assets/vendor/libs/jquery-repeater/jquery-repeater.js"></script>
    <script src="/assets/vendor/libs/flatpickr/flatpickr.js"></script>
    @endif

    <!-- Main JS -->
    <script src="/assets/js/main.js"></script>
    <script src="/js/content.js"></script>

    <!-- Page JS -->
    <script src="/assets/js/dashboards-analytics.js"></script>

    <!-- Additional Vendors JS -->
    {{-- Kalau mau tambah package disini --}}


    @yield('page-js')
</body>

</html>
