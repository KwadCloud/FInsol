@extends('admin.layouts.admin')

@section('content')
    <div class="row g-3 mb-3">
        <div class="col-md-12 col-xxl-3">
            <div class="card h-md-100 ecommerce-card-min-width">
                <div class="card-body d-flex flex-column justify-content-end">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-lg-4 ps-lg-2">
                                    @include('admin.pages.users.gst.section2')
                                </div>
                                <div class="col-lg-8 pe-lg-2">
                                    @include('admin.pages.users.gst.individuallist')
                                    @include('admin.pages.users.gst.firmlist')
                                    @include('admin.pages.users.gst.companylist')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
