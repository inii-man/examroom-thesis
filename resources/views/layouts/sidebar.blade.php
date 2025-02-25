<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ url('/') }}" class="app-brand-link">
            <span class="app-brand-logo demo" style="height: 40px;">
                <img src="{{ app_config('sidebar_logo') }}" class="img-fluid" alt="Sidebar Logo" style="height: 40px;">
            </span>
            <span class="app-brand-text demo menu-text fw-bold">{{ app_config('sidebar_name') }}</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-md align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        {{-- Dashboard --}}
        @if (isMenuHeaderVisible())
            <li class="menu-header small">
                <span class="menu-header-text" data-i18n="Dashboard">Dashboard</span>
            </li>
            <li class="menu-item {{ isActiveMenuItem('home') }}">
                <a href="/home" class="menu-link">
                    <i class="menu-icon ti ti-book"></i>
                    <div data-i18n="Batch Kelas">Batch Kelas</div>
                </a>
            </li>
            <li class="menu-item {{ isActiveMenuItem('bank-soal') }}">
                <a href="/home" class="menu-link">
                    <i class="menu-icon ti ti-list"></i>
                    <div data-i18n="Bank Soal">Bank Soal</div>
                </a>
            </li>
        @endif

        {{-- Master Data --}}
        @if (app_config('show_dummy') == 'true' || isSuperAdmin())
            @if (isMenuHeaderVisible(['ship.list', 'branch.list', 'light-house.list, perusahaan.list']))
                {{-- <li class="menu-header small">
                    <span class="menu-header-text" data-i18n="Master Data">Master Data</span>
                </li> --}}
                <li class="menu-item {{ isActiveSubMenu(['ships', 'branches', 'light-houses', 'perusahaan']) }}">
                    <a href="#" class="menu-link menu-toggle">
                        <i class="menu-icon ti ti-settings"></i>
                        <div data-i18n="Konfigurasi">Konfigurasi</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item {{ isActiveMenuItem('ships') }}">
                            <a href="/ships" class="menu-link">
                                <div data-i18n="Konfigurasi Pengguna">Konfigurasi Pengguna</div>
                            </a>
                        </li>
                    </ul>
                    {{-- <ul class="menu-sub">
                        <li class="menu-item {{ isActiveMenuItem('branches') }}">
                            <a href="/branches" class="menu-link">
                                <div data-i18n="Branches (Repeater)">Branches (Repeater)</div>
                            </a>
                        </li>
                    </ul> --}}
                    <ul class="menu-sub">
                        <li class="menu-item {{ isActiveMenuItem('perusahaan') }}">
                            <a href="/perusahaan" class="menu-link">
                                <div data-i18n="Konfigurasi Perusahaan">Konfigurasi Perusahaan</div>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
        @endif

        {{-- Configuration --}}
        @if (isMenuHeaderVisible())
            <li class="menu-header small">
                <span class="menu-header-text" data-i18n="Configuration">Configuration</span>
            </li>
            <li class="menu-item {{ isActiveMenuItem('profile') }}">
                <a href="/get-profile" class="menu-link">
                    <i class="menu-icon ti ti-user"></i>
                    <div data-i18n="My Profile">My Profile</div>
                </a>
            </li>
            @can('user.list')
                <li class="menu-item {{ isActiveMenuItem('users') }}">
                    <a href="/users" class="menu-link">
                        <i class="menu-icon ti ti-users"></i>
                        <div data-i18n="Users">Users</div>
                    </a>
                </li>
            @endcan
            @can('role.list')
            <li class="menu-item {{ isActiveMenuItem('roles') }}">
                <a href="/roles" class="menu-link">
                    <i class="menu-icon ti ti-settings"></i>
                    <div data-i18n="Roles & Permission">Roles & Permission</div>
                </a>
            </li>
            @endcan
            @can('config.manage')
            <li class="menu-item {{ isActiveMenuItem('config') }}">
                <a href="/get-config" class="menu-link">
                    <i class="menu-icon ti ti-table"></i>
                    <div data-i18n="App Config">App Config</div>
                </a>
            </li>
            @endcan
        @endif
    </ul>

</aside>
