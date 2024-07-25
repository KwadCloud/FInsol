@extends('user.layouts.app')
@section('content')
    <div class="row g-3">
        <div class="col-md-12 col-xxl-3">
            <div class="card h-md-100 ecommerce-card-min-width">
                <!-- <section> begin ============================-->
                <section class="text-center">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <h1 style="color: #2a3468;" class="fs-2 fs-sm-4 fs-md-5">User <span style="color:#ec465f">Settings
                                    </span>
                                </h1>

                            </div>

                            <!-------Upload documents open------>

                            <div class="row g-0">
                                <div class="col-xl-12">

                                    <div class="card-body">

                                        <label> Upload Document Settings: </label>

                                        @foreach ($settings as $setting)
                                            @if ($setting->status == 1)
                                                @if ($setting->value == 1)
                                                    <input type="checkbox" name="doc_type" value="1"
                                                        checked="checked" />Monthly
                                                @endif
                                                @if ($setting->value == 2)
                                                    <input type="checkbox" name="doc_type" value="2"
                                                        checked="checked" />Quarterly
                                                @endif
                                            @endif

                                            @if ($setting->status == 0)
                                                @if ($setting->value == 1)
                                                    <input type="checkbox" name="doc_type" value="1" />Monthly
                                                @endif
                                                @if ($setting->value == 2)
                                                    <input type="checkbox" name="doc_type" value="2" />Quarterly
                                                @endif
                                            @endif
                                        @endforeach
                                    </div>

                                </div>
                            </div>

                            <!-------Upload Documents Close----->

                        </div>
                    </div><!-- end of .container-->
                </section><!-- <section> close ============================-->
                <!-- ============================================-->

            </div>
        </div>
    @endsection
