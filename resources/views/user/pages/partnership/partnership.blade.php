<form class="needs-validation" novalidate="novalidate" action="{{ route('partnership.register') }}" method="post"
    enctype="multipart/form-data">
    @csrf

    <div class="detailsmargin card-header d-flex flex-between-center bg-light py-2">
        <h6 class="detailspadding mb-0">Details your Partnership</h6>
    </div>

    <!-- to be connected to backend --->
    <div class="mt-1 row g-2">
        <div class="col-6">
            <div class="mb-3">
                <label class="form-label" for="bootstrap-wizard-validation-wizard-partnership">Name of Firm
                </label><input class="form-control" type="text" pattern="[a-zA-Z\s]+" name="name_of_partnership"
                    placeholder="Name of Firm" required="required" />
                <div class="invalid-feedback">Please provide name of Firm</div>
            </div>
        </div>

        <div class="col-6">
            <div class="mb-3">
                <label class="form-label" for="bootstrap-wizard-validation-wizard-email">Business
                    Email</label><input class="form-control" type="email" name="partnership_email"
                    placeholder="Email address" pattern="^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$"
                    required="required" id="bootstrap-wizard-validation-wizard-email"
                    data-wizard-validate-email="true" />
                <div class="invalid-feedback">You must add email</div>
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label class="form-label" for="form-wizard-progress-wizard-addregnum">Mobile
                    number
                    registered with aadhar</label><input class="form-control" required="" type="text"
                    name="partnership_mobile" onkeypress="validate(event)"
                    oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                    maxlength="10" placeholder="Enter Mobile No" id="form-wizard-progress-wizard-addregnum" />
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
        @foreach ($partnership_images as $keyname => $image)
            <div class="col-6">
                <div class="mb-3">
                    <label>{{ $image['doc_name'] }} :</label>
                    <input type="file" name="{{ $image['doc_key_name'] }}[]" id="image-upload"
                        class="myfrm form-control" multiple />
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-1 row g-2" id="partnershippartnerGroup">
        <div class="detailsmargin card-header d-flex flex-between-center bg-light py-2">
            <h6 class="detailspadding mb-0">Upload documents of Partner</h6>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label class="form-label" for="bootstrap-wizard-validation-wizard-email">
                    Email</label><input class="form-control" type="email" name="partnershippartner[0][partner_email]"
                    placeholder="Email address" pattern="^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$"
                    id="bootstrap-wizard-validation-wizard-email" data-wizard-validate-email="true" />
                <div class="invalid-feedback">You must add email</div>
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label class="form-label" for="form-wizard-progress-wizard-addregnum">
                    Mobile number
                    registered with aadhar</label><input class="form-control" type="text"
                    name="partnershippartner[0][partner_mobile]" onkeypress="validate(event)"
                    oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                    maxlength="10" placeholder="Enter Mobile No" id="form-wizard-progress-wizard-addregnum" />
                <div class="invalid-feedback">Please provide Mobile
                    number</div>
            </div>
        </div>
        @foreach ($partnership_partner_images as $keyname => $image)
            <div class="col-4 mb-3">
                <div class="mb-3">
                    <label>{{ $image['doc_name'] }} :</label>
                    <!-- required="required"  -->
                    <input type="file" name="partnershippartner[0][{{ $image['doc_key_name'] }}][]" id="image-upload"
                        class="myfrm form-control" multiple />
                </div>
            </div>
        @endforeach
    </div>
    <div class="mt-1 row g-2">
        <button class="addpartnershippartner btn btn-primary me-1 mb-1" type="button">
            <span class="fas fa-plus me-1" data-fa-transform="shrink-3"></span>Add Partner
        </button>
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

<script>
    var partnershippartnerIndex = 0;
    $('.addpartnershippartner').click(function() {
        partnershippartnerIndex++;
        $(this).before(
            '<div class="mt-1 row g-2" id="partnershippartnerGroup"> <div class="detailsmargin card-header d-flex flex-between-center bg-light py-2"> <h6 class="detailspadding mb-0">Upload documents Partner</h6> </div> <div class="col-6"> <div class="mb-3"> <label class="form-label" for="bootstrap-wizard-validation-wizard-email"> Email</label><input class="form-control" type="email" name="partnershippartner[' +
            partnershippartnerIndex +
            '][partner_email]" placeholder="Email address" pattern="^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$" id="bootstrap-wizard-validation-wizard-email" data-wizard-validate-email="true"> <div class="invalid-feedback">You must add email</div> </div> </div> <div class="col-6"> <div class="mb-3"> <label class="form-label" for="form-wizard-progress-wizard-addregnum"> Mobile number registered with aadhar</label><input class="form-control" type="text" name="partnershippartner[' +
            partnershippartnerIndex +
            '][partner_mobile]" onkeypress="validate(event)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10" placeholder="Enter Registration No" id="form-wizard-progress-wizard-addregnum"> <div class="invalid-feedback">Please provide Mobile number</div> </div> </div> <div class="col-4 mb-3"> <div class="mb-3"> <label> Aadhar :</label> <!-- required="required" --> <input type="file" name="partnershippartner[' +
            partnershippartnerIndex +
            '][partner_pan_img][]" id="image-upload" class="myfrm form-control" multiple=""> </div> </div> <div class="col-4 mb-3"> <div class="mb-3"> <label> PAN :</label> <!-- required="required" --> <input type="file" name="partnershippartner[' +
            partnershippartnerIndex +
            '][partner_aadhar_img][]" id="image-upload" class="myfrm form-control" multiple=""> </div> </div> <div class="col-4 mb-3"> <div class="mb-3"> <label> Photo :</label> <!-- required="required" --> <input type="file" name="partnershippartner[' +
            partnershippartnerIndex +
            '][partner_photo_img][]" id="image-upload" class="myfrm form-control" multiple=""> </div> </div> <div class="col-4 mb-3"> <div class="mb-3"> <label> Spaceman signature :</label> <!-- required="required" --> <input type="file" name="partnershippartner[' +
            partnershippartnerIndex +
            '][partner_spaceman_img][]" id="image-upload" class="myfrm form-control" multiple=""> </div> </div> <div class="col-4 mb-3"> <div class="mb-3"> <label> Declaration :</label> <!-- required="required" --> <input type="file" name="partnershippartner[' +
            partnershippartnerIndex +
            '][partner_declare_img][]" id="image-upload" class="myfrm form-control" multiple=""> </div> </div> <div class="col-4 mb-3"> <div class="mb-3"> <label> Attorney and affidavit (Formet Attached)  :</label> <!-- required="required" --> <input type="file" name="partnershippartner[' +
            partnershippartnerIndex +
            '][partner_aff_img][]" id="image-upload" class="myfrm form-control" multiple=""> </div> </div> <div class="col-4 mb-3"> <div class="mb-3"> <label>Upload Other Documents :</label> <!-- required="required" --> <input type="file" name="partnershippartner[' +
            partnershippartnerIndex +
            '][docs_img][]" id="image-upload" class="myfrm form-control" multiple=""> </div> </div><div class="mt-1 row g-2"> <button class="deletepartnershippartner btn btn-outline-primary me-1 mb-1" type="button"><span class="fas fa-trash me-1" data-fa-transform="shrink-3"></span> Delete Partner </button> </div></div>'
        );
    });

    $(document).on('click', '.deletepartnershippartner', function() {
        $(this).parents("#partnershippartnerGroup").remove();
    });
</script>
