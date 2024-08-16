<!DOCTYPE html>
<html data-bs-theme="light" lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>Finsol | Admin Dashboard</title>

    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/admin/finsollogo180.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/admin/finsollogo32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/admin/finsollogo16.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/admin/favicon.ico') }}">
    <link rel="manifest" href="{{ asset('images/admin/site.webmanifest') }}">
    <meta name="msapplication-TileImage" content="{{ asset('images/admin/finsollogo180.png') }}">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        crossorigin="anonymous">
    <link href="{{ asset('vendors/datatables.net-bs5/dataTables.bootstrap5.min.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <script src="{{ asset('vendors/simplebar/simplebar.min.js') }}"></script>

    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:300,400,500,600,700,800,900&amp;display=swap"
        rel="stylesheet">
    <link href="{{ asset('vendors/simplebar/simplebar.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/theme.min.css') }}" rel="stylesheet" id="style-default">
    <link href="{{ asset('assets/css/user.min.css') }}" rel="stylesheet" id="user-style-default">
</head>

<body>
    <div id="app">
        <!-- ===============================================-->
        <!--    Main Content-->
        <!-- ===============================================-->
        <main class="main" id="top">
            <div class="container-fluid" data-layout="container">
                <!-- ===============================================-->
                <!--    Sidebar Content-->
                <!-- ===============================================-->
                <nav class="navbar navbar-light navbar-vertical navbar-expand-xl">
                    <div class="d-md-flex d-none align-items-center">
                        <div class="toggle-icon-wrapper">
                            <button class="btn navbar-toggler-humburger-icon navbar-vertical-toggle"
                                data-bs-toggle="tooltip" data-bs-placement="left" title="Toggle Navigation">
                                <span class="navbar-toggle-icon">
                                    <span class="toggle-line"></span>
                                </span>
                            </button>
                        </div>
                        <a class="navbar-brand" href="{{ url('admin') }}">
                            <div class="d-flex align-items-center py-3">
                                <a href="{{ url('admin') }}">
                                    <img class="me-2" src="{{ asset('assets/img/logos/finsol.png') }}" alt=""
                                        width="120" />
                                </a>
                            </div>
                        </a>
                    </div>
                    <!-- Current Sidebar -->
                    <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
                        <div class="navbar-vertical-content scrollbar">
                            <ul class="navbar-nav flex-column mb-3" id="navbarVerticalNav">
                                <li class="nav-item">
                                    <!-- parent pages-->
                                    <a class="nav-link {{ url()->current() === url('admin') ? 'active' : '' }}"
                                        href="{{ url('admin') }}">
                                        <div class="d-flex align-items-center">
                                            <span class="nav-link-icon">
                                                <span class="fas fa-chart-pie"></span>
                                            </span>
                                            <span class="nav-link-text ps-1 me-auto">Dashboard</span>
                                        </div>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link dropdown-indicator {{ str_contains(url()->current(), 'admin/users') ? 'collapsed active' : '' }}"
                                        href="#users" role="button" data-bs-toggle="collapse"
                                        aria-expanded="{{ str_contains(url()->current(), 'admin/users') ? 'true' : 'false' }}"
                                        aria-controls="forms">
                                        <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                                    class="fas fa-user-alt"></span></span><span
                                                class="nav-link-text ps-1">Users</span>
                                        </div>
                                    </a>
                                    <ul class="nav collapse {{ str_contains(url()->current(), 'admin/users') ? 'show' : '' }}"
                                        id="users">

                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ url('admin/users/all') }}">
                                                <div class="d-flex align-items-center"><span
                                                        class="nav-link-text ps-1">All Users</span>
                                                </div>
                                            </a><!-- more inner pages-->
                                        </li>
                                        @if (Auth::user()->type_of_user === 'Head Office')
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ url('admin/employee/all') }}">
                                                    <div class="d-flex align-items-center"><span
                                                            class="nav-link-text ps-1">All
                                                            Offices</span>
                                                    </div>
                                                </a><!-- more inner pages-->
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ url('admin/users/addform') }}">
                                                    <div class="d-flex align-items-center"><span
                                                            class="nav-link-text ps-1">Add
                                                            Office</span>
                                                    </div>
                                                </a><!-- more inner pages-->
                                            </li>
                                        @endif
                                    </ul>
                                </li>
                                @if (Auth::user()->type_of_user === 'Head Office')
                                    <li class="nav-item">
                                        <a class="nav-link dropdown-indicator {{ str_contains(url()->current(), 'admin/payment') ? 'collapsed active' : '' }}"
                                            href="#payment" role="button" data-bs-toggle="collapse"
                                            aria-expanded="{{ str_contains(url()->current(), 'admin/payment') ? 'true' : 'false' }}"
                                            aria-controls="forms">
                                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                                        class="fas fa-rupee-sign"></span></span><span
                                                    class="nav-link-text ps-1">Payment</span>
                                            </div>
                                        </a>
                                        <ul class="nav collapse {{ str_contains(url()->current(), 'admin/payment') ? 'show' : '' }}"
                                            id="payment">
                                            <li class="nav-item"><a class="nav-link"
                                                    href="{{ url('admin/payment/history') }}">
                                                    <div class="d-flex align-items-center"><span
                                                            class="nav-link-text ps-1">History</span>
                                                    </div>
                                                </a><!-- more inner pages-->
                                            </li>

                                            <li class="nav-item"><a class="nav-link"
                                                    href="{{ url('admin/payment/form-value') }}">
                                                    <div class="d-flex align-items-center"><span
                                                            class="nav-link-text ps-1">Form
                                                            Value</span>
                                                    </div>
                                                </a><!-- more inner pages-->
                                            </li>
                                        </ul>
                                    </li>
                                @else
                                    <li class="nav-item">
                                        <a class="nav-link dropdown-indicator {{ str_contains(url()->current(), 'admin/payment') ? 'collapsed active' : '' }}"
                                            href="#payment" role="button" data-bs-toggle="collapse"
                                            aria-expanded="{{ str_contains(url()->current(), 'admin/payment') ? 'true' : 'false' }}"
                                            aria-controls="forms">
                                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                                        class="fas fa-rupee-sign"></span></span><span
                                                    class="nav-link-text ps-1">Payment</span>
                                            </div>
                                        </a>
                                        <ul class="nav collapse {{ str_contains(url()->current(), 'admin/payment') ? 'show' : '' }}"
                                            id="payment">
                                            <li class="nav-item"><a class="nav-link"
                                                    href="{{ url('admin/payment/history') }}">
                                                    <div class="d-flex align-items-center"><span
                                                            class="nav-link-text ps-1">History</span>
                                                    </div>
                                                </a><!-- more inner pages-->
                                            </li>
                                        </ul>
                                    </li>
                                @endif
                                <li class="nav-item">
                                    <a class="nav-link dropdown-indicator {{ str_contains(url()->current(), 'admin/forms') ? 'collapsed active' : '' }}"
                                        href="#forms" role="button" data-bs-toggle="collapse"
                                        aria-expanded="{{ str_contains(url()->current(), 'admin/forms') ? 'true' : 'false' }}"
                                        aria-controls="forms">
                                        <div class="d-flex align-items-center">
                                            <span class="nav-link-icon">
                                                <span class="fas fa-file-alt"></span>
                                            </span>
                                            <span class="nav-link-text ps-1 me-auto">All
                                                Forms</span>
                                        </div>
                                    </a>
                                    <ul class="nav collapse {{ str_contains(url()->current(), 'admin/forms') ? 'show' : '' }}"
                                        id="forms">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ url('admin/forms/PAN?form_type=pan') }}">
                                                <div class="d-flex align-items-center">
                                                    <span class="nav-link-text ps-1 me-auto">PAN</span>

                                                    @php
                                                        $list = App\Http\Controllers\Admin\AdminController::user_list();
                                                        $users = [];
                                                        foreach ($list['users'] as $user) {
                                                            $users[] = (int) $user->id;
                                                        }

                                                        $proccessing = App\Models\UserPanDetail::where('status', 1)
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                        $query_updated = App\Models\UserPanDetail::where('status', 3)
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                    @endphp
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-primary">{{ $proccessing }}
                                                    </span>
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-warning">{{ $query_updated }}</span>
                                                </div>
                                            </a><!-- more inner pages-->
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ url('admin/forms/TAN?form_type=tan') }}">
                                                <div class="d-flex align-items-center">
                                                    <span class="nav-link-text ps-1 me-auto">TAN</span>

                                                    @php
                                                        $proccessing = App\Models\UserTanDetail::where('status', 1)
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                        $query_updated = App\Models\UserTanDetail::where('status', 3)
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                    @endphp
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-primary">{{ $proccessing }}
                                                    </span>
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-warning">{{ $query_updated }}</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ url('admin/forms/GST?form_type=gst') }}">
                                                <div class="d-flex align-items-center">
                                                    <span class="nav-link-text ps-1 me-auto">GST</span>

                                                    @php
                                                        $proccessing = App\Models\UserPanDetail::where('status', 1)
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                        $query_updated = App\Models\UserPanDetail::where('status', 3)
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                    @endphp
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-primary">{{ $proccessing }}
                                                    </span>
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-warning">{{ $query_updated }}</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ url('admin/forms/EPF?form_type=epf') }}">
                                                <div class="d-flex align-items-center">
                                                    <span class="nav-link-text ps-1 me-auto">EPF</span>

                                                    @php
                                                        $proccessing = App\Models\UserEpfDetail::where('status', 1)
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                        $query_updated = App\Models\UserEpfDetail::where('status', 3)
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                    @endphp
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-primary">{{ $proccessing }}
                                                    </span>
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-warning">{{ $query_updated }}</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ url('admin/forms/ESIC?form_type=esic') }}">
                                                <div class="d-flex align-items-center">
                                                    <span class="nav-link-text ps-1 me-auto">ESIC</span>

                                                    @php
                                                        $proccessing = App\Models\UserEsicDetail::where('status', 1)
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                        $query_updated = App\Models\UserEsicDetail::where('status', 3)
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                    @endphp
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-primary">{{ $proccessing }}
                                                    </span>
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-warning">{{ $query_updated }}</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link"
                                                href="{{ url('admin/forms/trademark?form_type=trademark') }}">
                                                <div class="d-flex align-items-center">
                                                    <span class="nav-link-text ps-1 me-auto">Trade
                                                        Mark</span>

                                                    @php
                                                        $proccessing = App\Models\UserTrademarkDetail::where(
                                                            'status',
                                                            1,
                                                        )
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                        $query_updated = App\Models\UserTrademarkDetail::where(
                                                            'status',
                                                            3,
                                                        )
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                    @endphp
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-primary">{{ $proccessing }}
                                                    </span>
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-warning">{{ $query_updated }}</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link"
                                                href="{{ url('admin/forms/company?form_type=company') }}">
                                                <div class="d-flex align-items-center">
                                                    <span class="nav-link-text ps-1 me-auto">Company</span>

                                                    @php
                                                        $proccessing = App\Models\UserCompanyDetail::where('status', 1)
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                        $query_updated = App\Models\UserCompanyDetail::where(
                                                            'status',
                                                            3,
                                                        )
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                    @endphp
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-primary">{{ $proccessing }}
                                                    </span>
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-warning">{{ $query_updated }}</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link"
                                                href="{{ url('admin/forms/partnership?form_type=partnership') }}">
                                                <div class="d-flex align-items-center">
                                                    <span class="nav-link-text ps-1 me-auto">Partnership</span>

                                                    @php
                                                        $proccessing = App\Models\UserPartnershipDetail::where(
                                                            'status',
                                                            1,
                                                        )
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                        $query_updated = App\Models\UserPartnershipDetail::where(
                                                            'status',
                                                            3,
                                                        )
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                    @endphp
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-primary">{{ $proccessing }}
                                                    </span>
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-warning">{{ $query_updated }}</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ url('admin/forms/HUF?form_type=huf') }}">
                                                <div class="d-flex align-items-center">
                                                    <span class="nav-link-text ps-1 me-auto">HUF</span>

                                                    @php
                                                        $proccessing = App\Models\UserHufDetail::where('status', 1)
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                        $query_updated = App\Models\UserHufDetail::where('status', 3)
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                    @endphp
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-primary">{{ $proccessing }}
                                                    </span>
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-warning">{{ $query_updated }}</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link"
                                                href="{{ url('admin/forms/trust?form_type=trust') }}">
                                                <div class="d-flex align-items-center">
                                                    <span class="nav-link-text ps-1 me-auto">Trust/NGO</span>

                                                    @php
                                                        $proccessing = App\Models\UserTrustDetail::where('status', 1)
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                        $query_updated = App\Models\UserTrustDetail::where('status', 3)
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                    @endphp
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-primary">{{ $proccessing }}
                                                    </span>
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-warning">{{ $query_updated }}</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link"
                                                href="{{ url('admin/forms/udamy?form_type=udamy') }}">
                                                <div class="d-flex align-items-center">
                                                    <span class="nav-link-text ps-1 me-auto">Udyam</span>

                                                    @php
                                                        $proccessing = App\Models\UserUdamyDetail::where('status', 1)
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                        $query_updated = App\Models\UserUdamyDetail::where('status', 3)
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                    @endphp
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-primary">{{ $proccessing }}
                                                    </span>
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-warning">{{ $query_updated }}</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link"
                                                href="{{ url('admin/forms/import-export?form_type=import') }}">
                                                <div class="d-flex align-items-center">
                                                    <span class="nav-link-text ps-1 me-auto">Import Export
                                                        Code</span>

                                                    @php
                                                        $proccessing = App\Models\UserImportExportDetail::where(
                                                            'status',
                                                            1,
                                                        )
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                        $query_updated = App\Models\UserImportExportDetail::where(
                                                            'status',
                                                            3,
                                                        )
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                    @endphp
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-primary">{{ $proccessing }}
                                                    </span>
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-warning">{{ $query_updated }}</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link"
                                                href="{{ url('admin/forms/labour?form_type=labour') }}">
                                                <div class="d-flex align-items-center">
                                                    <span class="nav-link-text ps-1 me-auto">Labour
                                                        Licence</span>

                                                    @php
                                                        $proccessing = App\Models\UserLabourDetail::where('status', 1)
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                        $query_updated = App\Models\UserLabourDetail::where('status', 3)
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                    @endphp

                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-primary">{{ $proccessing }}
                                                    </span>
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-warning">{{ $query_updated }}</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ url('admin/forms/shop?form_type=shop') }}">
                                                <div class="d-flex align-items-center">
                                                    <span class="nav-link-text ps-1 me-auto">Shop and
                                                        Establishment</span>

                                                    @php
                                                        $proccessing = App\Models\UserShopDetail::where('status', 1)
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                        $query_updated = App\Models\UserShopDetail::where('status', 3)
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                    @endphp
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-primary">{{ $proccessing }}
                                                    </span>
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-warning">{{ $query_updated }}</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ url('admin/forms/ISO?form_type=iso') }}">
                                                <div class="d-flex align-items-center">
                                                    <span class="nav-link-text ps-1 me-auto">ISO</span>

                                                    @php
                                                        $proccessing = App\Models\UserIsoDetail::where('status', 1)
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                        $query_updated = App\Models\UserIsoDetail::where('status', 3)
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                    @endphp
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-primary">{{ $proccessing }}
                                                    </span>
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-warning">{{ $query_updated }}</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ url('admin/forms/ISI?form_type=isi') }}">
                                                <div class="d-flex align-items-center">
                                                    <span class="nav-link-text ps-1 me-auto">ISI</span>

                                                    @php
                                                        $proccessing = App\Models\UserISIDetail::where('status', 1)
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                        $query_updated = App\Models\UserISIDetail::where('status', 3)
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                    @endphp
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-primary">{{ $proccessing }}
                                                    </span>
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-warning">{{ $query_updated }}</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link"
                                                href="{{ url('admin/forms/FSSAI?form_type=fssai') }}">
                                                <div class="d-flex align-items-center">
                                                    <span class="nav-link-text ps-1 me-auto">FSSAI
                                                        License</span>

                                                    @php
                                                        $proccessing = App\Models\UserFssaiDetail::where('status', 1)
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                        $query_updated = App\Models\UserFssaiDetail::where('status', 3)
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                    @endphp
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-primary">{{ $proccessing }}
                                                    </span>
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-warning">{{ $query_updated }}</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link"
                                                href="{{ url('admin/forms/factory-license?form_type=factory') }}">
                                                <div class="d-flex align-items-center">
                                                    <span class="nav-link-text ps-1 me-auto">Factory
                                                        License</span>

                                                    @php
                                                        $proccessing = App\Models\UserFactoryLicenseDetail::where(
                                                            'status',
                                                            1,
                                                        )
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                        $query_updated = App\Models\UserFactoryLicenseDetail::where(
                                                            'status',
                                                            3,
                                                        )
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                    @endphp
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-primary">{{ $proccessing }}
                                                    </span>
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-warning">{{ $query_updated }}</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ url('admin/forms/ITR?form_type=itr') }}">
                                                <div class="d-flex align-items-center">
                                                    <span class="nav-link-text ps-1 me-auto">ITR</span>

                                                    @php
                                                        $proccessing = App\Models\UserItrDetail::where('status', 1)
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                        $query_updated = App\Models\UserItrDetail::where('status', 3)
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                    @endphp
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-primary">{{ $proccessing }}
                                                    </span>
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-warning">{{ $query_updated }}</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ url('admin/forms/TDS?form_type=tds') }}">
                                                <div class="d-flex align-items-center">
                                                    <span class="nav-link-text ps-1 me-auto">TDS/TCS
                                                        Returns</span>

                                                    @php
                                                        $proccessing = App\Models\UserTdsDetail::where('status', 1)
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                        $query_updated = App\Models\UserTdsDetail::where('status', 3)
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                    @endphp
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-primary">{{ $proccessing }}
                                                    </span>
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-warning">{{ $query_updated }}</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link"
                                                href="{{ url('admin/forms/tax-audit?form_type=tax') }}">
                                                <div class="d-flex align-items-center">
                                                    <span class="nav-link-text ps-1 me-auto">Tax
                                                        Audit</span>

                                                    @php
                                                        $proccessing = App\Models\UserTaxauditDetail::where('status', 1)
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                        $query_updated = App\Models\UserTaxauditDetail::where(
                                                            'status',
                                                            3,
                                                        )
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                    @endphp
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-primary">{{ $proccessing }}
                                                    </span>
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-warning">{{ $query_updated }}</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link"
                                                href="{{ url('admin/forms/statutory-audit?form_type=sa') }}">
                                                <div class="d-flex align-items-center">
                                                    <span class="nav-link-text ps-1 me-auto">Statutory
                                                        Audit</span>

                                                    @php
                                                        $proccessing = App\Models\CompaniesAct\UserStatutoryAuditDetail::where(
                                                            'status',
                                                            1,
                                                        )
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                        $query_updated = App\Models\CompaniesAct\UserStatutoryAuditDetail::where(
                                                            'status',
                                                            3,
                                                        )
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                    @endphp
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-primary">{{ $proccessing }}
                                                    </span>
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-warning">{{ $query_updated }}</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link"
                                                href="{{ url('admin/forms/DIN-KYC?form_type=din_kyc') }}">
                                                <div class="d-flex align-items-center">
                                                    <span class="nav-link-text ps-1 me-auto">DIN KYC</span>

                                                    @php
                                                        $proccessing = App\Models\CompaniesAct\UserDinkycDetail::where(
                                                            'status',
                                                            1,
                                                        )
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                        $query_updated = App\Models\CompaniesAct\UserDinkycDetail::where(
                                                            'status',
                                                            3,
                                                        )
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                    @endphp
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-primary">{{ $proccessing }}
                                                    </span>
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-warning">{{ $query_updated }}</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ url('admin/forms/AOC?form_type=aoc') }}">
                                                <div class="d-flex align-items-center">
                                                    <span class="nav-link-text ps-1 me-auto">AOC-4</span>

                                                    @php
                                                        $proccessing = App\Models\CompaniesAct\UserAocDetail::where(
                                                            'status',
                                                            1,
                                                        )
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                        $query_updated = App\Models\CompaniesAct\UserAocDetail::where(
                                                            'status',
                                                            3,
                                                        )
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                    @endphp
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-primary">{{ $proccessing }}
                                                    </span>
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-warning">{{ $query_updated }}</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ url('admin/forms/MGT?form_type=mgt') }}">
                                                <div class="d-flex align-items-center">
                                                    <span class="nav-link-text ps-1 me-auto">MGT-7</span>

                                                    @php
                                                        $proccessing = App\Models\CompaniesAct\UserMgtDetail::where(
                                                            'status',
                                                            1,
                                                        )
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                        $query_updated = App\Models\CompaniesAct\UserMgtDetail::where(
                                                            'status',
                                                            3,
                                                        )
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                    @endphp
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-primary">{{ $proccessing }}
                                                    </span>
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-warning">{{ $query_updated }}</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ url('admin/forms/ADT?form_type=adt') }}">
                                                <div class="d-flex align-items-center">
                                                    <span class="nav-link-text ps-1 me-auto">ADT-1</span>

                                                    @php
                                                        $proccessing = App\Models\CompaniesAct\UserAdtDetail::where(
                                                            'status',
                                                            1,
                                                        )
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                        $query_updated = App\Models\CompaniesAct\UserAdtDetail::where(
                                                            'status',
                                                            3,
                                                        )
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                    @endphp
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-primary">{{ $proccessing }}
                                                    </span>
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-warning">{{ $query_updated }}</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link"
                                                href="{{ url('admin/forms/minute?form_type=minute') }}">
                                                <div class="d-flex align-items-center">
                                                    <span class="nav-link-text ps-1 me-auto">Minutes</span>

                                                    @php
                                                        $proccessing = App\Models\CompaniesAct\UserMinutesDetail::where(
                                                            'status',
                                                            1,
                                                        )
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                        $query_updated = App\Models\CompaniesAct\UserMinutesDetail::where(
                                                            'status',
                                                            3,
                                                        )
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                    @endphp
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-primary">{{ $proccessing }}
                                                    </span>
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-warning">{{ $query_updated }}</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link"
                                                href="{{ url('admin/forms/legal-form?form_type=legal') }}">
                                                <div class="d-flex align-items-center">
                                                    <span class="nav-link-text ps-1 me-auto">
                                                        Legal Form
                                                    </span>

                                                    @php
                                                        $proccessing = App\Models\LegalWork::where('status', 1)
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                        $query_updated = App\Models\LegalWork::where('status', 3)
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                    @endphp
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-primary">{{ $proccessing }}
                                                    </span>
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-warning">{{ $query_updated }}</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link"
                                                href="{{ url('admin/forms/estimated?form_type=estimated') }}">
                                                <div class="d-flex align-items-center">
                                                    <span class="nav-link-text ps-1 me-auto">Estimated/Projected</span>

                                                    @php
                                                        $proccessing = App\Models\LoanFinance\Estimated::where(
                                                            'status',
                                                            1,
                                                        )
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                        $query_updated = App\Models\LoanFinance\Estimated::where(
                                                            'status',
                                                            3,
                                                        )
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                    @endphp
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-primary">{{ $proccessing }}
                                                    </span>
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-warning">{{ $query_updated }}</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ url('admin/forms/CMA?form_type=cma') }}">
                                                <div class="d-flex align-items-center">
                                                    <span class="nav-link-text ps-1 me-auto">CMA</span>

                                                    @php
                                                        $proccessing = App\Models\LoanFinance\CMA::where('status', 1)
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                        $query_updated = App\Models\LoanFinance\CMA::where('status', 3)
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                    @endphp
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-primary">{{ $proccessing }}
                                                    </span>
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-warning">{{ $query_updated }}</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link"
                                                href="{{ url('admin/forms/project-report?form_type=project_report') }}">
                                                <div class="d-flex align-items-center">
                                                    <span class="nav-link-text ps-1 me-auto">Project
                                                        Report</span>

                                                    @php
                                                        $proccessing = App\Models\LoanFinance\ProjectReport::where(
                                                            'status',
                                                            1,
                                                        )
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                        $query_updated = App\Models\LoanFinance\ProjectReport::where(
                                                            'status',
                                                            3,
                                                        )
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                    @endphp
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-primary">{{ $proccessing }}
                                                    </span>
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-warning">{{ $query_updated }}</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ url('admin/forms/CA?form_type=ca') }}">
                                                <div class="d-flex align-items-center">
                                                    <span class="nav-link-text ps-1 me-auto">CA
                                                        Certificate</span>

                                                    @php
                                                        $proccessing = App\Models\Certification\UserCaDetail::where(
                                                            'status',
                                                            1,
                                                        )
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                        $query_updated = App\Models\Certification\UserCaDetail::where(
                                                            'status',
                                                            3,
                                                        )
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                    @endphp
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-primary">{{ $proccessing }}
                                                    </span>
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-warning">{{ $query_updated }}</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link"
                                                href="{{ url('admin/forms/net-worth?form_type=worth') }}">
                                                <div class="d-flex align-items-center">
                                                    <span class="nav-link-text ps-1 me-auto">Networth</span>

                                                    @php
                                                        $proccessing = App\Models\Certification\UserNetworthDetail::where(
                                                            'status',
                                                            1,
                                                        )
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                        $query_updated = App\Models\Certification\UserNetworthDetail::where(
                                                            'status',
                                                            3,
                                                        )
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                    @endphp
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-primary">{{ $proccessing }}
                                                    </span>
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-warning">{{ $query_updated }}</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link"
                                                href="{{ url('admin/forms/turnover?form_type=turnover') }}">
                                                <div class="d-flex align-items-center">
                                                    <span class="nav-link-text ps-1 me-auto">Turnover
                                                        Certificate</span>

                                                    @php
                                                        $proccessing = App\Models\Certification\UserTurnoverDetail::where(
                                                            'status',
                                                            1,
                                                        )
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                        $query_updated = App\Models\Certification\UserTurnoverDetail::where(
                                                            'status',
                                                            3,
                                                        )
                                                            ->whereIn('user_id', $users)
                                                            ->count();
                                                    @endphp
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-primary">{{ $proccessing }}
                                                    </span>
                                                    <span
                                                        class="badge rounded-pill ms-2 badge-subtle-warning">{{ $query_updated }}</span>
                                                </div>
                                            </a>
                                            <!-- more inner pages-->
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link dropdown-indicator {{ str_contains(url()->current(), 'admin/status') ? 'collapsed active' : '' }}"
                                        href="#status" role="button" data-bs-toggle="collapse"
                                        aria-expanded="{{ str_contains(url()->current(), 'admin/status') ? 'true' : 'false' }}"
                                        aria-controls="forms">
                                        <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                                    class="fas fa-exclamation-circle"></span></span><span
                                                class="nav-link-text ps-1">Status</span>
                                        </div>
                                    </a>
                                    <ul class="nav collapse {{ str_contains(url()->current(), 'admin/status') ? 'show' : '' }}"
                                        id="status">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ url('admin/status/processing') }}">
                                                <div class="d-flex align-items-center">
                                                    <span class="nav-link-text ps-1 me-auto">Processing</span>
                                                    <span class="badge rounded-pill ms-2 badge-subtle-warning">
                                                        {{ App\Http\Controllers\Admin\AdminController::formCount(1) }}
                                                    </span>
                                                </div>
                                            </a><!-- more inner pages-->
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ url('admin/status/query-raised') }}">
                                                <div class="d-flex align-items-center">
                                                    <span class="nav-link-text ps-1 me-auto">Query
                                                        Raised</span>
                                                    <span class="badge rounded-pill ms-2 badge-subtle-warning">
                                                        {{ App\Http\Controllers\Admin\AdminController::formCount(2) }}
                                                    </span>
                                                </div>
                                            </a><!-- more inner pages-->
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ url('admin/status/query-updated') }}">
                                                <div class="d-flex align-items-center">
                                                    <span class="nav-link-text ps-1 me-auto">Query
                                                        Updated</span>
                                                    <span class="badge rounded-pill ms-2 badge-subtle-warning">
                                                        {{ App\Http\Controllers\Admin\AdminController::formCount(3) }}
                                                    </span>
                                                </div>
                                            </a><!-- more inner pages-->
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ url('admin/status/approved') }}">
                                                <div class="d-flex align-items-center">
                                                    <span class="nav-link-text ps-1 me-auto">Approved</span>
                                                    <span class="badge rounded-pill ms-2 badge-subtle-warning">
                                                        {{ App\Http\Controllers\Admin\AdminController::formCount(4) }}
                                                    </span>
                                                </div>
                                            </a><!-- more inner pages-->
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <div class="content">
                    <nav class="navbar navbar-light navbar-glass navbar-top navbar-expand">
                        <button class="btn navbar-toggler-humburger-icon navbar-toggler me-1 me-sm-3" type="button"
                            data-bs-toggle="collapse" data-bs-target="#navbarVerticalCollapse"
                            aria-controls="navbarVerticalCollapse" aria-expanded="false"
                            aria-label="Toggle Navigation">
                            <span class="navbar-toggle-icon">
                                <span class="toggle-line"></span>
                            </span>
                        </button>
                        <a class="navbar-brand me-1 me-sm-3" href="{{ url('admin') }}">
                            <div class="d-flex align-items-center">
                                <img class="me-2" src="{{ asset('assets/img/logos/finsol.png') }}" alt=""
                                    width="80" />
                            </div>
                        </a>
                        <ul class="navbar-nav navbar-nav-icons ms-auto flex-row align-items-center">
                            <li class="nav-item px-2">
                                <div class="theme-control-toggle fa-icon-wait"><input
                                        class="form-check-input ms-0 theme-control-toggle-input"
                                        id="themeControlToggle" type="checkbox" data-theme-control="theme"
                                        value="dark" /><label
                                        class="mb-0 theme-control-toggle-label theme-control-toggle-light"
                                        for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left"
                                        title="Switch to light theme"><span
                                            class="fas fa-sun fs-0"></span></label><label
                                        class="mb-0 theme-control-toggle-label theme-control-toggle-dark"
                                        for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left"
                                        title="Switch to dark theme"><span class="fas fa-moon fs-0"></span></label>
                                </div>
                            </li>
                            <li class="nav-item dropdown"><a class="nav-link pe-0 ps-2" id="navbarDropdownUser"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <div class="avatar avatar-xl">
                                        <img class="rounded-circle" src="{{ asset('images/admin/finsollogo.png') }}"
                                            alt="" />
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-caret dropdown-caret dropdown-menu-end py-0"
                                    aria-labelledby="navbarDropdownUser">
                                    <div class="bg-white dark__bg-1000 rounded-2 py-2">
                                        <!-- <a class="dropdown-item" href="pages/authentication/card/logout.html">Logout1</a> -->
                                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                                            style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                        <a class="dropdown-item"
                                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </nav>
                    <!-- ===============================================-->
                    <!--   End of Sidebar Content-->
                    <!-- ===============================================-->
                    @yield('content')

                    <footer class="footer">
                        <div class="row g-0 justify-content-between fs--1 mt-4 mb-3">
                            <div class="col-12 col-sm-auto text-center">
                                <p class="mb-0 text-600">All Rights Reserved <span class="d-none d-sm-inline-block">|
                                    </span><br class="d-sm-none" /> 2024 &copy; <a href="https://kwad.in/">Kwad</a>
                                </p>
                            </div>
                            <div class="col-12 col-sm-auto text-center">
                                <p class="mb-0 text-600">v1.0.0</p>
                            </div>
                        </div>
                    </footer>
                </div>
            </div>
        </main><!-- ===============================================-->
        <!--    End of Main Content-->
        <!-- ===============================================-->
        @include('admin.pages.users.modal')
    </div>
    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('vendors/datatables.net/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-bs5/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('vendors/popper/popper.min.js') }}"></script>
    <script src="{{ asset('vendors/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendors/anchorjs/anchor.min.js') }}"></script>
    <script src="{{ asset('vendors/is/is.min.js') }}"></script>
    <script src="{{ asset('vendors/fontawesome/all.min.js') }}"></script>
    <script src="{{ asset('vendors/lodash/lodash.min.js') }}"></script>
    <script src="{{ asset('vendors/list.js/list.min.js') }}"></script>
    <script src="{{ asset('assets/js/theme.js') }}"></script>
    <script>
        var urlpath = "{{ url('/register') }}";

        $(document).ready(function() {
            $('#filter-select-state').change(function() {
                var stateId = $(this).val();
                console.log(urlpath);
                if (stateId) {
                    $.ajax({
                        url: urlpath + '/get-districts/' + stateId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#filter-select-district').empty().append(
                                '<option value="">Select District</option>');
                            $.each(data, function(key, value) {
                                $('#filter-select-district').append('<option value="' +
                                    value
                                    .d_code + '">' + value.name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#filter-select-district').empty().append(
                        '<option value="">Select District</option>');
                    $('#filter-select-block').empty().append('<option value="">Select Block</option>');
                }
            });

            $('#filter-select-district').change(function() {
                var districtId = $(this).val();
                if (districtId) {
                    $.ajax({
                        url: urlpath + '/get-blocks/' + districtId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#filter-select-block').empty().append(
                                '<option value="">Select Block</option>');
                            $.each(data, function(key, value) {
                                $('#filter-select-block').append('<option value="' +
                                    value.id +
                                    '">' + value.name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#filter-select-block').empty().append('<option value="">Select Block</option>');
                }
            });
        });

        //Export table to csv file
        class csvExport {
            constructor(table, header = true) {
                this.table = table;
                this.rows = Array.from(table.querySelectorAll("tr"));
                if (!header && this.rows[0].querySelectorAll("th").length) {
                    this.rows.shift();
                }
            }

            exportCsv() {
                const lines = [];
                const ncols = this._longestRow();
                for (const row of this.rows) {
                    let line = "";
                    for (let i = 0; i < ncols; i++) {
                        if (row.children[i] !== undefined) {
                            line += csvExport.safeData(row.children[i]);
                        }
                        line += i !== ncols - 1 ? "," : "";
                    }
                    lines.push(line);
                }
                //console.log(lines);
                return lines.join("\n");
            }
            _longestRow() {
                return this.rows.reduce((length, row) => (row.childElementCount > length ? row.childElementCount :
                    length), 0);
            }
            static safeData(td) {
                let data = td.textContent;
                data = data.replace(/ /g, "");
                data = data.replace(/\n/g, "");
                //Replace all double quote to two double quotes
                data = data.replace(/"/g, `""`);
                //Replace , and \n to double quotes
                data = /[",\n"]/.test(data) ? `"${data}"` : data;
                return data;
            }
        }

        const btnExport = document.querySelector("#btnExport");
        const btnMore = document.querySelector('a[data-btn="show-more"]');
        const tableElement = document.querySelector("table");

        btnExport.addEventListener("click", () => {
            btnMore.click(() => {}, 500);
            const obj = new csvExport(tableElement);
            const csvData = obj.exportCsv();
            const blob = new Blob([csvData], {
                type: "text/csv"
            });
            const url = URL.createObjectURL(blob);
            const a = document.createElement("a");
            a.href = url;
            a.download = "Export.csv";
            a.click();

            setTimeout(() => {
                URL.revokeObjectURL(url);
            }, 500);
        });
    </script>
    @yield('js')
</body>

</html>
