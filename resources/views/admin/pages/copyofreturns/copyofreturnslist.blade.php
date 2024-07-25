@extends('admin.layouts.admin')

{{-- @push('custom_styles') --}}
{{-- @endpush --}}

@section('content')
    <div class="row g-3 mb-3">
        <div class="col-md-12 col-xxl-3">
            <div class="card h-md-100 ecommerce-card-min-width">
                <div class="card-header pb-0 d-flex align-items-center">
                    <h6 class="mb-0 mt-2 d-flex align-items-center">Add / List of Copy Of Returns</h6>
                    <button id="btnExport" type="button" class="btn btn-success btn-sm ms-auto">
                        <i class="fa fa-file-csv"></i> Export to CSV
                    </button>
                </div>

                <div class="card-body d-flex flex-column justify-content-end">
                    <div class="row">
                        <div class="col-12">
                            @if (session('success'))
                                <div class="alert alert-success border-2 d-flex align-items-center" role="alert">
                                    <div class="bg-success me-3 icon-item"><span
                                            class="fas fa-check-circle text-white fs-3"></span>
                                    </div>
                                    <p class="mb-0 flex-1">{{ session('success') }}</p>
                                    <button class="btn-close" type="button" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            @include('admin.pages.copyofreturns.add')
                        </div>
                        <div class="col-auto ps-0">
                            <div class="echart-bar-weekly-sales h-100"></div>
                        </div>
                    </div>
                </div>

                <div class="card-body d-flex flex-column justify-content-end">
                    <div class="row">

                        <div class="col-12">
                            @if (session('success_delete'))
                                <div class="alert alert-success border-2 d-flex align-items-center" role="alert">
                                    <div class="bg-success me-3 icon-item"><span
                                            class="fas fa-check-circle text-white fs-3"></span>
                                    </div>
                                    <p class="mb-0 flex-1">{{ session('success_delete') }}</p>
                                    <button class="btn-close" type="button" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            @if (session('filenotexist'))
                                <div class="alert alert-danger border-2 d-flex align-items-center" role="alert">
                                    <div class="bg-danger me-3 icon-item"><span
                                            class="fas fa-check-circle text-white fs-3"></span>
                                    </div>
                                    <p class="mb-0 flex-1">{{ session('filenotexist') }}</p>
                                    <button class="btn-close" type="button" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            @include('admin.pages.copyofreturns.list')
                        </div>
                        <div class="col-auto ps-0">
                            <div class="echart-bar-weekly-sales h-100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
