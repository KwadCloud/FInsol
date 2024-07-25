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
                                <h1 style="color: #2a3468;" class="fs-2 fs-sm-4 fs-md-5">Upload <span style="color:#ec465f">Documents
                                    </span>
                                </h1>
                                <p class="lead">Things you will get right out of the box with Finsol.</p>
                            </div>

                            <!-------Upload documents open------>

                            <div class="row g-0">
                                <div class="col-xl-12">
                                    <div class="card-body" bis_skin_checked="1">

                                        @if (session('success'))
                                            <div class="alert alert-success border-2 d-flex align-items-center"
                                                role="alert">
                                                <div class="bg-success me-3 icon-item"><span
                                                        class="fas fa-check-circle text-white fs-3"></span>
                                                </div>
                                                <p class="mb-0 flex-1">{{ session('success') }}</p>
                                                <button class="btn-close" type="button" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        @endif

                                        <div class="tab-content">
                                            <div class="tab-pane preview-tab-pane active" role="tabpanel"
                                                aria-labelledby="tab-dom-61c83f7c-d9df-458a-94bd-f4e645b55d13"
                                                id="dom-61c83f7c-d9df-458a-94bd-f4e645b55d13">
                                                <ul class="nav nav-pills" id="pill-myTab" role="tablist">

                                                    <li class="nav-item"><a class="nav-link active" id="pill-home-tab"
                                                            data-bs-toggle="tab" href="#pill-tab-home" role="tab"
                                                            aria-controls="pill-tab-home" aria-selected="true">Monthly</a>
                                                    </li>

                                                    <li class="nav-item"><a class="nav-link" id="pill-profile-tab"
                                                            data-bs-toggle="tab" href="#pill-tab-profile" role="tab"
                                                            aria-controls="pill-tab-profile"
                                                            aria-selected="false">Quarterly</a></li>

                                                </ul>
                                                <div class="tab-content mt-3" id="pill-myTabContent">

                                                    <!------------------tab 1----------------->

                                                    @include('user.pages.gst.uploadDocuments.monthly')

                                                    <!------------Tab 2 ------------>

                                                    @include('user.pages.gst.uploadDocuments.quarterly')

                                                </div>
                                            </div>
                                        </div>

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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        var urlpath = "{{ url('/') }}";

        function getTradeName2() {

            var gstValue = $('#gstSelect2').val();
            $('.tradeName2').val('')
            $('.gstid2').val('')
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            if (gstValue) {
                $.ajax({
                    url: urlpath + '/gettradename',
                    type: 'POST',
                    data: {
                        gst: gstValue
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {
                        // Handle the response from the server
                        $('.tradeName2').val(response.trade_name);
                        $('.gstid2').val(response.id);

                    },
                    error: function(xhr, status, error) {
                        // Handle any errors that occur during the AJAX request
                        console.error(error);
                    }
                });
            }
        }

        function getTradeName() {

            var gstValue = $('#gstSelect').val();
            $('.tradeName').val('')
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            if (gstValue) {
                $.ajax({
                    url: urlpath + '/gettradename',
                    type: 'POST',
                    data: {
                        gst: gstValue
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {
                        // Handle the response from the server
                        $('.tradeName').val(response.trade_name);
                        $('.gstid').val(response.id);
                        // console.log(response);
                    },
                    error: function(xhr, status, error) {
                        // Handle any errors that occur during the AJAX request
                        console.error(error);
                    }
                });
            }
        }
    </script>
