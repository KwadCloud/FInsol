<div class="tab-pane fade" id="esic-existing" role="tabpanel" aria-labelledby="existing-tab">
    <div class="d-flex mb-4">
        <span class="fa-stack me-2 ms-n1"><i class="fas fa-circle fa-stack-2x text-300"></i><i
                class="fa-inverse fa-stack-1x text-primary fas fa-check-double"></i></span>
        <div class="col">
            <h5 class="mb-0 text-primary position-relative"><span class="bg-200 dark__bg-1100 pe-3">Existing ESIC
                    Registration</span><span
                    class="border position-absolute top-50 translate-middle-y w-100 start-0 z-n1"></span>
            </h5>
            <p class="mb-0">Get your existing ESIC registration done quicly with Finsol.</p>
        </div>
    </div>
    <div class="row g-0">
        <div class="col-xl-12">
            <div class="card mb-3">
                <div class="card-header">
                    <h6 class="mb-0">Select the Registration type</h6>
                </div>
                <div class="card-body">
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
                    <div class="tab-content">
                        <div class="tab-pane preview-tab-pane active" role="tabpanel"
                            aria-labelledby="tab-dom-61c83f7c-d9df-458a-94bd-f4e645b55d13"
                            id="dom-61c83f7c-d9df-458a-94bd-f4e645b55d13">
                            <ul class="nav nav-pills" id="pill-myTab" role="tablist">
                                <li class="nav-item"><a class="nav-link active" id="esic-existing-company-home"
                                        data-bs-toggle="tab" href="#esic-existing-company" role="tab"
                                        aria-controls="esic-existing-company" aria-selected="true">Company</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" id="esic-existing-company-other"
                                        data-bs-toggle="tab" href="#esic-existing-others" role="tab"
                                        aria-controls="esic-existing-others" aria-selected="false">Others</a></li>

                            </ul>
                            <div class="tab-content mt-3" id="pill-myExistingContent">
                                <!------------------tab 1----------------->
                                <div class="tab-pane fade show active" id="esic-existing-company" role="tabpanel"
                                    aria-labelledby="existing-home-tab">
                                    <form class="needs-validation" novalidate="novalidate"
                                        action="{{ route('esic.register.company') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="esic_type" value="Company" />
                                        <div class="detailsmargin card-header d-flex flex-between-center bg-light py-2">
                                            <h6 class="detailspadding mb-0">Details of your Business</h6>
                                        </div>
                                        <!-- to be connected to backend --->
                                        <div class="mt-1 row g-2">
                                            <div class="col-6">
                                                <div class="mb-3">
                                                    <label class="form-label"
                                                        for="bootstrap-wizard-validation-wizard-company">
                                                        ESIC Number
                                                    </label>
                                                    <input class="form-control" type="text"
                                                        pattern="[0-9]+" name="name_of_esic" placeholder="ESIC Number"
                                                        required="required" />
                                                    <div class="invalid-feedback">Please provide ESIC Number</div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- to be connected to backend --->
                                        <div class="mt-1 row g-2">
                                            @foreach ($esic_company_images as $keyname => $image)
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label>{{ $image['doc_name'] }} Upload :</label>
                                                        <input type="file" name="{{ $image['doc_key_name'] }}[]"
                                                            id="image-upload" class="myfrm form-control" multiple />
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                        <div class="mt-1 row g-2" id="esicsignatoryGroup">
                                            <div
                                                class="detailsmargin card-header d-flex flex-between-center bg-light py-2">
                                                <h6 class="detailspadding mb-0">Upload documents of Signatory</h6>
                                            </div>
                                            <div class="col-6">
                                                <div class="mb-3">
                                                    <label class="form-label"
                                                        for="bootstrap-wizard-validation-wizard-email">
                                                        Email</label><input class="form-control" type="email"
                                                        name="esicsignatory[0][email]" placeholder="Email address"
                                                        pattern="^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$"
                                                        id="bootstrap-wizard-validation-wizard-email"
                                                        data-wizard-validate-email="true" required="required"/>
                                                    <div class="invalid-feedback">You must add email</div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="mb-3">
                                                    <label class="form-label"
                                                        for="form-wizard-progress-wizard-addregnum">
                                                        Mobile number
                                                        registered with aadhar</label><input class="form-control"
                                                        type="text" name="esicsignatory[0][mobile]" maxlength="10" onkeypress="validate(event)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10"
                                                        placeholder="Enter Mobile No"
                                                        id="form-wizard-progress-wizard-addregnum" required="required"/>
                                                    <div class="invalid-feedback">Please provide Mobile
                                                        number</div>
                                                </div>
                                            </div>
                                            @foreach ($esic_company_signatory_images as $keyname => $image)
                                                <div class="col-4 mb-3">
                                                    <div class="mb-3">
                                                        <label>Upload {{ $image['doc_name'] }} :</label>
                                                        <!-- required="required"  -->
                                                        <input type="file"
                                                            name="esicsignatory[0][{{ $image['doc_key_name'] }}][]"
                                                            id="image-upload" class="myfrm form-control" multiple />
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="mt-1 row g-2">
                                            <button class="addesicsignatory btn btn-primary me-1 mb-1" type="button">
                                                <span class="fas fa-plus me-1" data-fa-transform="shrink-3"></span>Add
                                                Signatory
                                            </button>
                                        </div>

                                        <br />
                                        <br />
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <button class="btn btn-primary me-1 mb-1" type="submit">Submit &
                                                    Pay</button>
                                                <p>Amount: ₹{{ $amount_esi_ci }}</p>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <script>
                                    var esicsignatoryIndex = 0;
                                    $('.addesicsignatory').click(function() {
                                        esicsignatoryIndex++;
                                        $(this).before(
                                            '<div class="mt-1 row g-2" id="esicsignatoryGroup"> <div class="detailsmargin card-header d-flex flex-between-center bg-light py-2"> <h6 class="detailspadding mb-0">Upload documents of Add Signatory</h6> </div> <div class="col-6"> <div class="mb-3"> <label class="form-label" for="bootstrap-wizard-validation-wizard-email"> Email</label><input class="form-control" type="email" name="esicsignatory[' +
                                            esicsignatoryIndex +
                                            '][email]" placeholder="Email address" pattern="^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$" id="bootstrap-wizard-validation-wizard-email" data-wizard-validate-email="true"> <div class="invalid-feedback">You must add email</div> </div> </div> <div class="col-6"> <div class="mb-3"> <label class="form-label" for="form-wizard-progress-wizard-addregnum"> Mobile number registered with aadhar</label><input class="form-control" type="text" name="esicsignatory[' +
                                            esicsignatoryIndex +
                                            '][mobile]" maxlength="10" onkeypress="validate(event)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="Enter Registration No" id="form-wizard-progress-wizard-addregnum"> <div class="invalid-feedback">Please provide Mobile number</div> </div> </div> <div class="col-4 mb-3"> <div class="mb-3"> <label>Upload Aadhar :</label> <!-- required="required" --> <input type="file" name="esicsignatory[' +
                                            esicsignatoryIndex +
                                            '][esic_sign_pan_img][]" id="image-upload" class="myfrm form-control" multiple=""> </div> </div> <div class="col-4 mb-3"> <div class="mb-3"> <label>Upload PAN :</label> <!-- required="required" --> <input type="file" name="esicsignatory[' +
                                            esicsignatoryIndex +
                                            '][esic_sign_aadhar_img][]" id="image-upload" class="myfrm form-control" multiple=""> </div> </div> <div class="col-4 mb-3"> <div class="mb-3"> <label>Upload Photo :</label> <!-- required="required" --> <input type="file" name="esicsignatory[' +
                                            esicsignatoryIndex +
                                            '][esic_sign_photo_img][]" id="image-upload" class="myfrm form-control" multiple=""> </div> </div> <div class="col-4 mb-3"> <div class="mb-3"> <label>Upload Spaceman signature :</label> <!-- required="required" --> <input type="file" name="esicsignatory[' +
                                            esicsignatoryIndex +
                                            '][esic_sign_spaceman_img][]" id="image-upload" class="myfrm form-control" multiple=""> </div> </div> <div class="col-4 mb-3"> <div class="mb-3"> <label>Upload Declaration :</label> <!-- required="required" --> <input type="file" name="esicsignatory[' +
                                            esicsignatoryIndex +
                                            '][esic_sign_declare_img][]" id="image-upload" class="myfrm form-control" multiple=""> </div> </div><div class="mt-1 row g-2"> <button class="deleteesicsignatory btn btn-outline-primary me-1 mb-1" type="button"><span class="fas fa-trash me-1" data-fa-transform="shrink-3"></span> Delete Signatory </button> </div></div>'


                                        );
                                    });

                                    $(document).on('click', '.deleteesicsignatory', function() {
                                        $(this).parents("#esicsignatoryGroup").remove();
                                    });
                                </script>

                                <!------------Tab 2 ------------>
                                <div class="tab-pane fade" id="esic-existing-others" role="tabpanel"
                                    aria-labelledby="existing-profile-tab">
                                    <form class="needs-validation" novalidate="novalidate"
                                        action="{{ route('esic.register.others') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="esic_type" value="Others" />
                                        <div
                                            class="detailsmargin card-header d-flex flex-between-center bg-light py-2">
                                            <h6 class="detailspadding mb-0">Details of your Business</h6>
                                        </div>
                                        <div class="mt-1 row g-2">

                                            <!-- to be connected to backend --->
                                            <div class="mt-1 row g-2">
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label class="form-label"
                                                            for="bootstrap-wizard-validation-wizard-company">
                                                            ESIC Number
                                                        </label><input class="form-control" type="text"
                                                            name="name_of_esic" placeholder="ESIC Number"
                                                            required="required" />
                                                        <div class="invalid-feedback">Please provide ESIC Number
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- to be connected to backend --->

                                            <div
                                                class="detailsmargin card-header d-flex flex-between-center bg-light py-2">
                                                <h6 class="detailspadding mb-0">Upload documents</h6>
                                            </div>
                                            <div class="row g-2 ">
                                                @foreach ($esic_other_images as $keyname => $image)
                                                    <div class="col-6 mb-3">
                                                        <div class="mb-3">
                                                            <label>{{ $image['doc_name'] }} Upload :</label>
                                                            <!-- required="required"  -->
                                                            <input type="file"
                                                                name="{{ $image['doc_key_name'] }}[]"
                                                                id="image-upload" class="myfrm form-control"
                                                                multiple />
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="col-4">
                                                <div class="mb-3">
                                                    <button class="btn btn-primary me-1 mb-1" type="submit">Submit
                                                        &
                                                        Pay</button>
                                                    <p>Amount: ₹{{ $amount }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
