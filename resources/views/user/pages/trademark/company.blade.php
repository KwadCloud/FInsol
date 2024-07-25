<div class="tab-pane fade show active" id="trademark-company" role="tabpanel" aria-labelledby="home-tab">
    <form class="needs-validation" novalidate="novalidate" action="{{ route('trademark.register.company') }}" method="post"
        enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="trademark_type" value="Company" />
        <div class="detailsmargin card-header d-flex flex-between-center bg-light py-2">
            <h6 class="detailspadding mb-0">Details of your Business</h6>
        </div>
        <!-- to be connected to backend --->
        <div class="mt-1 row g-2">
            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label" for="bootstrap-wizard-validation-wizard-company">Name of Trademark
                    </label><input class="form-control" type="text" pattern="[a-zA-Z\s]+" name="name_of_trademark"
                        placeholder="Name of Trademark" required="required" />
                    <div class="invalid-feedback">Please provide name of Trademark</div>
                </div>
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label" for="bootstrap-wizard-validation-wizard-company">Name of Business
                    </label><input class="form-control" type="text" pattern="[a-zA-Z\s]+" name="name_of_business"
                        placeholder="Name of Business" required="required" />
                    <div class="invalid-feedback">Please provide name of Business</div>
                </div>
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label" for="bootstrap-wizard-validation-wizard-email">Business
                        Email</label><input class="form-control" type="email" value="{{ Auth::user()->email }}"
                        name="email_id" placeholder="Email address"
                        pattern="^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$" required="required"
                        id="bootstrap-wizard-validation-wizard-email" data-wizard-validate-email="true" />
                    <div class="invalid-feedback">You must add email</div>
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label" for="form-wizard-progress-wizard-addregnum">Mobile
                        number
                        registered with aadhar</label><input class="form-control" required="" type="text"
                        name="mobile_number" onkeypress="validate(event)"
                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                        value="{{ Auth::user()->mobile }}" maxlength="10" maxlength="10" placeholder="Enter Mobile No"
                        id="form-wizard-progress-wizard-addregnum" />
                    <div class="invalid-feedback">Please provide Mobile
                        number</div>
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label" for="bootstrap-wizard-validation-wizard-email">
                        Registration Type
                    </label>
                    <select class="form-control" name="registrion_type" required>
                        <option value="new" selected>New Registration</option>
                        <option value="renewal">Renewal</option>
                    </select>  
                </div>
            </div>
        </div>
        <!-- to be connected to backend --->
        <div class="mt-1 row g-2">
            @foreach ($trademark_company_images as $keyname => $image)
                <div class="col-6">
                    <div class="mb-3">
                        <label>{{ $image['doc_name'] }} :</label>
                        <input type="file" name="{{ $image['doc_key_name'] }}[]" id="image-upload"
                            class="myfrm form-control" multiple />
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-1 row g-2" id="trademarksignatoryGroup">
            <div class="detailsmargin card-header d-flex flex-between-center bg-light py-2">
                <h6 class="detailspadding mb-0">Upload documents of Signatory</h6>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label" for="bootstrap-wizard-validation-wizard-email">
                        Email</label><input class="form-control" type="email" name="trademarksignatory[0][email]"
                        placeholder="Email address" required="required"
                        pattern="^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$"
                        id="bootstrap-wizard-validation-wizard-email" data-wizard-validate-email="true" />
                    <div class="invalid-feedback">You must add email</div>
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label" for="form-wizard-progress-wizard-addregnum">
                        Mobile number
                        registered with aadhar</label><input class="form-control" type="text"
                        name="trademarksignatory[0][mobile]" maxlength="10" onkeypress="validate(event)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required="required" placeholder="Enter Mobile No"
                        id="form-wizard-progress-wizard-addregnum" />
                    <div class="invalid-feedback">Please provide Mobile
                        number</div>
                </div>
            </div>
            @foreach ($trademark_company_signatory_images as $keyname => $image)
                <div class="col-4 mb-3">
                    <div class="mb-3">
                        <label>{{ $image['doc_name'] }} :</label>
                        <!-- required="required"  -->
                        <input type="file" name="trademarksignatory[0][{{ $image['doc_key_name'] }}][]"
                            id="image-upload" class="myfrm form-control" multiple />
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-1 row g-2">
            <button class="addtrademarksignatory btn btn-primary me-1 mb-1" type="button">
                <span class="fas fa-plus me-1" data-fa-transform="shrink-3"></span>Add Signatory
            </button>
        </div>

        <br />
        <br />
        <div class="col-4">
            <div class="mb-3">
                <button class="btn btn-primary me-1 mb-1" type="submit">Submit & Pay</button>
                <p>Amount: ₹{{ $amount_trade_cs }}</p>
            </div>
        </div>
    </form>
</div>

<script>
    var trademarksignatoryIndex = 0;
    $('.addtrademarksignatory').one('click',function() {
        trademarksignatoryIndex++;
        $(this).before(
            '<div class="mt-1 row g-2" id="trademarksignatoryGroup"> <div class="detailsmargin card-header d-flex flex-between-center bg-light py-2"> <h6 class="detailspadding mb-0">Upload documents of Add Signatory</h6> </div> <div class="col-6"> <div class="mb-3"> <label class="form-label" for="bootstrap-wizard-validation-wizard-email"> Email</label><input class="form-control" type="email" name="trademarksignatory[' +
            trademarksignatoryIndex +
            '][email]" placeholder="Email address" pattern="^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$" id="bootstrap-wizard-validation-wizard-email" data-wizard-validate-email="true"> <div class="invalid-feedback">You must add email</div> </div> </div> <div class="col-6"> <div class="mb-3"> <label class="form-label" for="form-wizard-progress-wizard-addregnum"> Mobile number registered with aadhar</label><input class="form-control" type="text" name="trademarksignatory[' +
            trademarksignatoryIndex +
            '][mobile]" maxlength="10" onkeypress="validate(event)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="Enter Registration No" id="form-wizard-progress-wizard-addregnum"> <div class="invalid-feedback">Please provide Mobile number</div> </div> </div> <div class="col-4 mb-3"> <div class="mb-3"> <label> Aadhar :</label> <!-- required="required" --> <input type="file" name="trademarksignatory[' +
            trademarksignatoryIndex +
            '][trademark_sign_pan_img][]" id="image-upload" class="myfrm form-control" multiple=""> </div> </div> <div class="col-4 mb-3"> <div class="mb-3"> <label> PAN :</label> <!-- required="required" --> <input type="file" name="trademarksignatory[' +
            trademarksignatoryIndex +
            '][trademark_sign_aadhar_img][]" id="image-upload" class="myfrm form-control" multiple=""> </div> </div> <div class="col-4 mb-3"> <div class="mb-3"> <label> Photo :</label> <!-- required="required" --> <input type="file" name="trademarksignatory[' +
            trademarksignatoryIndex +
            '][trademark_sign_photo_img][]" id="image-upload" class="myfrm form-control" multiple=""> </div> </div> <div class="col-4 mb-3"> <div class="mb-3"> <label> Spaceman signature :</label> <!-- required="required" --> <input type="file" name="trademarksignatory[' +
            trademarksignatoryIndex +
            '][trademark_sign_spaceman_img][]" id="image-upload" class="myfrm form-control" multiple=""> </div> </div> <div class="col-4 mb-3"> <div class="mb-3"> <label> Declaration :</label> <!-- required="required" --> <input type="file" name="trademarksignatory[' +
            trademarksignatoryIndex +
            '][trademark_sign_declare_img][]" id="image-upload" class="myfrm form-control" multiple=""> </div> </div><div class="col-4 mb-3"> <div class="mb-3"> <label>Attorney and affidavit (Formet Attached) :</label> <!-- required="required" --> <input type="file" name="trademarksignatory[' +
            trademarksignatoryIndex +
            '][trademark_signaff_img][]" id="image-upload" class="myfrm form-control" multiple=""> </div> </div><div class="col-4 mb-3"> <div class="mb-3"> <label>Upload Other Documents :</label> <!-- required="required" --> <input type="file" name="trademarksignatory[' +
            trademarksignatoryIndex +
            '][docs_img][]" id="image-upload" class="myfrm form-control" multiple=""> </div> </div><div class="mt-1 row g-2"> <button class="deletetrademarksignatory btn btn-outline-primary me-1 mb-1" type="button"><span class="fas fa-trash me-1" data-fa-transform="shrink-3"></span> Delete Signatory </button> </div></div>'
        );
    });

    $(document).on('click', '.deletetrademarksignatory', function() {
        $(this).parents("#trademarksignatoryGroup").remove();
    });
</script>
