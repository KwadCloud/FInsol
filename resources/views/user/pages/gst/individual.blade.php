<div class="tab-pane fade show active" id="pill-tab-home" role="tabpanel" aria-labelledby="home-tab">
    <form class="needs-validation" novalidate="novalidate" action="{{ route('gst.individual') }}" method="post"
        enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="gst_type" value="Individual" />
        <div class="detailsmargin card-header d-flex flex-between-center bg-light py-2">
            <h6 class="detailspadding mb-0">Details of your Business</h6>
        </div>
        <div class="mt-1 row g-2">
            <div class="col-4">
                <div class="mb-3">
                    <label class="form-label" for="form-wizard-progress-wizard-legalnamename">Trade
                        Name of
                        the
                        Business</label><input required="" class="form-control" type="text" name="trade_name"
                        placeholder="Legal Name of Business" id="form-wizard-progress-wizard-legalname"
                        data-wizard-validate-legal-name="true" />
                    <div class="invalid-feedback">Please provide Trade Name
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="mb-3">
                    <label class="form-label" for="bootstrap-wizard-validation-wizard-email">Business
                        Email</label><input class="form-control" type="email" name="email_id"
                        value="{{ Auth::user()->email }}" placeholder="Email address"
                        pattern="^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$" required="required"
                        id="bootstrap-wizard-validation-wizard-email" data-wizard-validate-email="true" />
                    <div class="invalid-feedback">You must add email</div>
                </div>
            </div>
            <div class="col-4">
                <div class="mb-3">
                    <label class="form-label" for="form-wizard-progress-wizard-addregnum">Mobile
                        number
                        registered with aadhar</label><input class="form-control" required="" type="text"
                        name="mobile_linked_aadhar" maxlength="10" placeholder="Enter Mobile No"
                        id="form-wizard-progress-wizard-addregnum" />
                    <div class="invalid-feedback">Please provide Mobile
                        number</div>
                </div>
            </div>
            <div class="detailsmargin card-header d-flex flex-between-center bg-light py-2">
                <h6 class="detailspadding mb-0">Upload documents of
                    individual applicant</h6>
            </div>
            <div class="row g-2 ">
                @foreach ($images as $keyname => $image)
                    <div class="col-4 mb-3">
                        <div class="mb-3">
                            <label>{{ $image['doc_name'] }} Upload :</label>
                            <!-- required="required"  -->
                            <input type="file" name="{{ $image['doc_key_name'] }}[]" id="image-upload"
                                class="myfrm form-control" multiple />
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-4">
                <div class="mb-3">
                    <button class="btn btn-primary me-1 mb-1" type="submit">Submit & Pay</button>
                    <p>Amount: ₹{{ $amount }}</p>
                </div>
            </div>
        </div>
    </form>
</div>
