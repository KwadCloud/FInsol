@extends('user.layouts.app')
@section('content')
    <div class="row g-3 mb-3">
        <div class="col-md-12 col-xxl-3">
            <div class="card h-md-100 ecommerce-card-min-width">
                <!-- ============================================-->
                <!-- <section> begin ============================-->
                <section class="text-center">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <h1 style="color: #2a3468;" class="fs-2 fs-sm-4 fs-md-5">Hello
                                    {{ Auth::user()->name }}, Welcome to
                                    <span style="color:#ec465f">Finsol GST</span>
                                </h1>
                                <p class="lead">Things you will get right out of the box with Finsol.</p>
                            </div>
                        </div>

                        <!------ GST options drop ------->

                        <div class="row mt-6 g-3">
                            @if (isset($userGstDetails))
                                @if (
                                    $userGstDetails->status == '3' ||
                                        $userGstDetails->status == '2' ||
                                        $userGstDetails->status == '1' ||
                                        $userGstDetails->status == '4')
                                    <div class="col-lg-4">
                                        <div onclick="location.href='{{ route('gst.business_status') }}'" type="button">
                                            <div class="card card-span h-100">
                                                <div class="roundlogobg topcurves">
                                                    <h2 class="roundtext">Business Status </h2>
                                                </div>
                                                <div class="card-body">
                                                    <p>Check for the Business Status</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endif
                            <div class="col-lg-4">
                                <div onclick="location.href='{{ route('gst.register_form') }}'" type="button">
                                    <div class="card card-span h-100">
                                        <div class="roundlogobg topcurves">
                                            <h2 class="roundtext">New Registration</h2>
                                        </div>
                                        <div class="card-body">
                                            <p>New Registration for GST </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div onclick="location.href='{{ route('gst.existing_register_form') }}'" type="button">
                                    <div class="card card-span h-100">
                                        <div class="roundlogobg topcurves">
                                            <h2 class="roundtext">Existing Registration</h2>
                                        </div>
                                        <div class="card-body">
                                            <p>Existing Registration for GST </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row mt-4 g-3">

                            @if (isset($userGstApprovedDetails))
                                @if ($userGstApprovedDetails->status == '4')
                                    <div class="col-lg-4">
                                        <div onclick="location.href='{{ route('gst.copy_of_returns') }}'" type="button">
                                            <div class="card card-span h-100">
                                                <div class="roundlogobg topcurves">
                                                    <h2 class="roundtext">Copy Of Returns</h2>
                                                </div>
                                                <div class="card-body">
                                                    <p>Copy Of Returns</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endif

                            @if (isset($userGstApprovedDetails))
                                @if ($userGstApprovedDetails->status == '4')
                                    <div class="col-lg-4">
                                        <div onclick="location.href='{{ route('gst.uploaddocuments') }}'" type="button">
                                            <div class="card card-span h-100">
                                                <div class="roundlogobg topcurves">
                                                    <h2 class="roundtext">Upload Documents</h2>
                                                </div>
                                                <div class="card-body">
                                                    <p>Upload Documents</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="card card-span h-100">
                                            <div class="roundlogobg topcurves">
                                                <h2 class="roundtext">Hearing & Appeal</h2>
                                            </div>
                                            <div class="card-body">
                                                <p>Hearing and Appeal</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        </div>

                        <!------ GST options drop close ------->
                    </div>
            </div><!-- end of .container-->
            </section><!-- <section> close ============================-->
            <!-- ============================================-->

        </div>
    </div>
@endsection
