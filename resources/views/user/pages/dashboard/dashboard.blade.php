@extends('user.layouts.app')
@section('content')
    @php
        use App\Models\UserGstDetail;
    @endphp
    <div class="row g-3">
        <div class="col-xl-12">
            <div class="card mb-3">
                <div class="card-body text-center">
                    <h1 style="color: #2a3468;" class="fs-2 fs-sm-4 fs-md-5">Registration<span style="color:#ec465f">
                            Status
                        </span>
                    </h1>
                    <p class="lead">Things you will get right out of the box with Finsol.</p>

                    @if (session('payment_success'))
                        <div class="alert alert-success border-2 d-flex align-items-center" role="alert">
                            <div class="bg-success me-3 icon-item"><span class="fas fa-check-circle text-white fs-3"></span>
                            </div>
                            <p class="mb-0 flex-1">{{ session('payment_success') }}</p>
                            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="table-responsive scrollbar">
                        @if (session('success'))
                            <div class="alert alert-success border-2 d-flex align-items-center" role="alert">
                                <div class="bg-success me-3 icon-item"><span
                                        class="fas fa-check-circle text-white fs-3"></span>
                                </div>
                                <p class="mb-0 flex-1">{{ session('success') }}
                                </p>
                                <button class="btn-close" type="button" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session('raisedfilenotexist'))
                            <div class="alert alert-danger border-2 d-flex align-items-center" role="alert">
                                <div class="bg-danger me-3 icon-item"><span
                                        class="fas fa-check-circle text-white fs-3"></span>
                                </div>
                                <p class="mb-0 flex-1">
                                    {{ session('raisedfilenotexist') }}</p>
                                <button class="btn-close" type="button" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session('approvedfilenotexist'))
                            <div class="alert alert-danger border-2 d-flex align-items-center" role="alert">
                                <div class="bg-danger me-3 icon-item"><span
                                        class="fas fa-check-circle text-white fs-3"></span>
                                </div>
                                <p class="mb-0 flex-1">
                                    {{ session('approvedfilenotexist') }}</p>
                                <button class="btn-close" type="button" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        @include('user.pages.dashboard.gst')
                        @include('user.pages.dashboard.pan')
                        @include('user.pages.dashboard.tan')
                        @include('user.pages.dashboard.epf')
                        @include('user.pages.dashboard.esic')
                        @include('user.pages.dashboard.trademark')
                        @include('user.pages.dashboard.company')
                        @include('user.pages.dashboard.partnership')
                        @include('user.pages.dashboard.huf')
                        @include('user.pages.dashboard.trust')
                        @include('user.pages.dashboard.udamy')
                        @include('user.pages.dashboard.importexport')
                        @include('user.pages.dashboard.labour')
                        @include('user.pages.dashboard.shop')
                        @include('user.pages.dashboard.iso')
                        @include('user.pages.dashboard.fssai')
                        @include('user.pages.dashboard.itr')
                        @include('user.pages.dashboard.taxaudit')
                        @include('user.pages.dashboard.tds')
                        @include('user.pages.dashboard.factorylicense')
                        @include('user.pages.dashboard.isi')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    .hiddenRow {
        padding: 0 !important;
    }

    .hiddenRow1 {
        padding: 0 !important;
    }

    .hiddenRow2 {
        padding: 0 !important;
    }
</style>
