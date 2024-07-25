@extends('user.layouts.app')
@section('content')
    <div class="d-flex mb-4">
        <span class="fa-stack me-2 ms-n1"><i class="fas fa-circle fa-stack-2x text-300"></i><i
                class="fa-inverse fa-stack-1x text-primary fas fa-check-double"></i></span>
        <div class="col">
            <h5 class="mb-0 text-primary position-relative"><span class="bg-200 dark__bg-1100 pe-3">Existing GST
                    Registration</span><span
                    class="border position-absolute top-50 translate-middle-y w-100 start-0 z-n1"></span>
            </h5>
            <p class="mb-0">You can easily show your stats content by using these cards.</p>
        </div>
    </div>
    <div class="row g-0">
        <div class="col-xl-12">
            <div class="card mb-3">

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success border-2 d-flex align-items-center" role="alert">
                            <div class="bg-success me-3 icon-item"><span class="fas fa-check-circle text-white fs-3"></span>
                            </div>
                            <p class="mb-0 flex-1">{{ session('success') }}</p>
                            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form class="needs-validation" novalidate="novalidate" action="{{ route('gst.existing') }}"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="gst_type" value="Firm" />
                        <div class="detailsmargin card-header d-flex flex-between-center bg-light py-2">
                            <h6 class="detailspadding mb-0">Details of your Existing Business</h6>
                        </div>
                        <div class="mt-1 row g-2">

                            @error('gst_number')
                                <div class="alert alert-danger border-2 d-flex align-items-center" role="alert">
                                    <div class="bg-danger me-3 icon-item"><span
                                            class="fas fa-check-circle text-white fs-3"></span>
                                    </div>
                                    <p class="mb-0 flex-1">{{ $message }}</p>
                                    <button class="btn-close" type="button" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                                <!-- <span style="color:red">{{ $message }}</span> -->
                            @enderror

                            <div class="col-4">
                                <div class="mb-3">
                                    <label class="form-label" for="form-wizard-progress-wizard-legalnamename">Trade
                                        Name of
                                        the
                                        Business</label><input required="" class="form-control" type="text"
                                        name="trade_name" placeholder="Trade Name of Business"
                                        value="{{ old('trade_name') }}" id="form-wizard-progress-wizard-legalname"
                                        data-wizard-validate-legal-name="true" />
                                    <div class="invalid-feedback">Please provide Trade Name
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <label class="form-label" for="bootstrap-wizard-validation-wizard-email">Email
                                        of your
                                        firm</label><input class="form-control" type="email" name="email_id"
                                        placeholder="Email address"
                                        pattern="^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$"
                                        required="required" value="{{ Auth::user()->email }}"
                                        id="bootstrap-wizard-validation-wizard-email" data-wizard-validate-email="true" />
                                    <div class="invalid-feedback">You must add email</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">

                                    <label class="form-label" for="form-wizard-progress-wizard-addregnum">GST
                                        number
                                        of firm</label><input class="form-control" required="" type="text"
                                        value="{{ old('gst_number') }}" name="gst_number" placeholder="Enter GST No"
                                        id="form-wizard-progress-wizard-addregnum" />
                                    <div class="invalid-feedback">Please provide GST
                                        number </div>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="mb-3">
                                    <label class="form-label" for="form-wizard-progress-wizard-addregnum">GST
                                        Portal User
                                        Id </label><input class="form-control" value="{{ old('gst_id') }}" required=""
                                        type="text" name="gst_id" placeholder="GST Id"
                                        id="form-wizard-progress-wizard-addregnum" />
                                    <div class="invalid-feedback">Please provide GST Portal User
                                        Id</div>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="mb-3">
                                    <label class="form-label" for="form-wizard-progress-wizard-addregnum">GST
                                        Portal
                                        Password </label><input class="form-control" required="" type="password"
                                        name="gst_password" placeholder="GST Password"
                                        id="form-wizard-progress-wizard-addregnum" />
                                    <div class="invalid-feedback">Please provide GST Portal
                                        Password</div>
                                </div>
                            </div>

                        </div>

                        <br />
                        <br />
                        <div class="col-4">
                            <div class="mb-3">
                                <button class="btn btn-primary me-1 mb-1" type="submit">Submit & Pay</button>
                                <p>Amount: ₹{{ $amount }}</p>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!--- add Partner JS  -->
@endsection
