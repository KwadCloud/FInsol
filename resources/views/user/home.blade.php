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
                            <div class="col py-md-10">
                                <h1 style="color: #2a3468;" class="fs-2 fs-sm-4 fs-md-5">Hello
                                    {{ Auth::user()->name }}! <br>Welcome to <span style="color:#ec465f">Finsol</span>
                                </h1>
                                <p class="lead">Explore things you will get right out of the box with Finsol.</p>
                            </div>
                        </div>
                    </div><!-- end of .container-->
                </section>
            </div>
        </div>
    </div>
    @include('user.partials.authmodal')
@endsection
