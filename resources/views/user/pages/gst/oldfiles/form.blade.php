@extends('user.layouts.app')
@section('content')
    <link href="{{ asset('vendors/dropzone/dropzone.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('vendors/dropzone/dropzone.min.js') }}"></script>

    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />

    <div class="row mt-5 mt-lg-0 mt-xl-5 mt-xxl-0">
        <div class="col-lg-6 col-xl-12 col-xxl-6 h-100">
            <div class="d-flex mb-4">
                <span class="fa-stack me-2 ms-n1"><i class="fas fa-circle fa-stack-2x text-300"></i><i
                        class="fa-inverse fa-stack-1x text-primary fas fa-check-double"></i></span>
                <div class="col">
                    <h5 class="mb-0 text-primary position-relative"><span class="bg-200 dark__bg-1100 pe-3">New
                            GST Registration</span><span
                            class="border position-absolute top-50 translate-middle-y w-100 start-0 z-n1"></span>
                    </h5>
                    <p class="mb-0">You can easily show your stats content by using these cards.</p>
                </div>
            </div>

            <div class="card theme-wizard h-100 mb-5">
                <div class="card-header bg-light pt-3 pb-2">
                    <ul class="nav justify-content-between nav-wizard for_gst_form">
                        <li class="nav-item">
                            <a class="nav-link active fw-semi-bold" href="#bootstrap-wizard-validation-tab1"
                                data-bs-toggle="tab" data-wizard-step="data-wizard-step">
                                <input type="radio" name="gstType" value="1">
                                <img src="{{ asset('assets/img/team/3-thumb.png') }}" alt="Option 2">
                                <span class="d-none d-md-block mt-1 fs--1">For<br>Individual</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-semi-bold" href="#bootstrap-wizard-validation-tab2" data-bs-toggle="tab"
                                data-wizard-step="data-wizard-step">
                                <input type="radio" name="gstType" value="1">
                                <img src="{{ asset('assets/img/team/3-thumb.png') }}" alt="Option 2">
                                <span class="d-none d-md-block mt-1 fs--1">For<br>Firm</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-semi-bold" href="#bootstrap-wizard-validation-tab3" data-bs-toggle="tab"
                                data-wizard-step="data-wizard-step">
                                <input type="radio" name="gstType" value="1">
                                <img src="{{ asset('assets/img/team/3-thumb.png') }}" alt="Option 2">
                                <span class="d-none d-md-block mt-1 fs--1">For<br>Company</span>
                            </a>
                        </li>
                    </ul>

                </div>
                <div class="card-body py-4" id="wizard-controller">
                    <div class="tab-content">
                        <!------------------tab 1----------------->
                        @include('user.pages.gst.individual_form')
                        <!------------Tab 2 ------------>
                        @include('user.pages.gst.firm_form')
                        <!--------------tab 3 ------------>
                        @include('user.pages.gst.company_form')
                    </div>
                </div>

                <!-- <div class="btn-group" data-toggle="buttons">
                                        <label class="btn btn-secondary active">
                                            <input type="radio" name="options" id="option1" checked> Tab 1
                                        </label>
                                        <label class="btn btn-secondary">
                                            <input type="radio" name="options" id="option2"> Tab 2
                                        </label>
                                        <label class="btn btn-secondary">
                                            <input type="radio" name="options" id="option3"> Tab 3
                                        </label>
                                    </div>

                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab1">
                                            This is the content for Tab 1.
                                        </div>
                                        <div class="tab-pane" id="tab2">
                                            This is the content for Tab 2.
                                        </div>
                                        <div class="tab-pane" id="tab3">
                                            This is the content for Tab 3.
                                        </div>
                                    </div> -->

            </div>
        </div>
    </div>
@endsection

<style>
    /* HIDE RADIO */
    .for_gst_form .nav-item [type=radio] {
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
    }

    /* IMAGE STYLES */
    .for_gst_form .nav-item [type=radio]+img {
        cursor: pointer;
    }

    /* CHECKED STYLES */
    .for_gst_form .nav-link.active {
        outline: 1px solid gray;
        background-color: white;
    }
</style>
