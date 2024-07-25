<div class="tab-pane fade" id="pill-tab-contact" role="tabpanel" aria-labelledby="profile-tab">
    <form class="needs-validation" novalidate="novalidate" action="{{ route('gst.company') }}" method="post"
        enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="gst_type" value="Company" />
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
                        placeholder="Trade Name of Business" id="form-wizard-progress-wizard-legalname"
                        data-wizard-validate-legal-name="true" />
                    <div class="invalid-feedback">Please provide Trade Name
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="mb-3">
                    <label class="form-label" for="bootstrap-wizard-validation-wizard-email">Email
                        of your
                        company</label><input class="form-control" type="email" name="email_id"
                        placeholder="Email address" value="{{ Auth::user()->email }}"
                        pattern="^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$" required="required"
                        id="bootstrap-wizard-validation-wizard-email" data-wizard-validate-email="true" />
                    <div class="invalid-feedback">You must add email</div>
                </div>
            </div>
            <div class="col-4">
                <div class="mb-3">
                    <label class="form-label" for="form-wizard-progress-wizard-addregnum">Mobile
                        number
                        of company</label><input class="form-control" required="" type="text"
                        name="mobile_linked_aadhar" maxlength="10" placeholder="Enter Mobile No"
                        id="form-wizard-progress-wizard-addregnum" />
                    <div class="invalid-feedback">Please provide Mobile
                        number</div>
                </div>
            </div>

            @foreach ($company_images as $keyname => $image)
                <div class="col-4">
                    <div class="mb-3">
                        <label>{{ $image['doc_name'] }} Upload :</label>

                        <input type="file" name="{{ $image['doc_key_name'] }}[]" id="image-upload"
                            class="myfrm form-control" multiple />
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-1 row g-2" id="directorGroup">
            <div class="detailsmargin card-header d-flex flex-between-center bg-light py-2">
                <h6 class="detailspadding mb-0">Upload documents of
                    Directors</h6>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label" for="bootstrap-wizard-validation-wizard-email">Directors
                        Email</label><input class="form-control" required="required" type="email"
                        name="directors[0][email]" placeholder="Email address"
                        pattern="^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$"
                        id="bootstrap-wizard-validation-wizard-email" data-wizard-validate-email="true" />
                    <div class="invalid-feedback">You must add email</div>
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label" for="form-wizard-progress-wizard-addregnum">Directors
                        Mobile number
                        registered with aadhar</label><input class="form-control" type="text"
                        name="directors[0][mobile]" maxlength="10" onkeypress="validate(event)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required="required" placeholder="Enter Registration No"
                        id="form-wizard-progress-wizard-addregnum" />
                    <div class="invalid-feedback">Please provide Mobile
                        number</div>
                </div>
            </div>
            @foreach ($company_director_images as $keyname => $image)
                <div class="col-6 mb-3">
                    <div class="mb-3">
                        <label>Upload {{ $image['doc_name'] }} :</label>
                        <!-- required="required"  -->
                        <input type="file" name="directors[0][{{ $image['doc_key_name'] }}][]" id="image-upload"
                            class="myfrm form-control" multiple />
                    </div>
                </div>
            @endforeach

        </div>
        <div class="mt-1 row g-2">
            <button class="adddirector btn btn-primary me-1 mb-1" type="button">
                <span class="fas fa-plus me-1" data-fa-transform="shrink-3"></span>Add Directors
            </button>
        </div>

        <br />
        <br />
        <div class="col-4">
            <div class="mb-3">
                <button class="btn btn-primary me-1 mb-1" type="submit">Submit & Pay</button>
                <p>Amount: ₹{{ $amount_ci }}</p>
            </div>
        </div>
    </form>
</div>

<script>
    var directorIndex = 0;
    $('.adddirector').click(function() {
        directorIndex++;
        $(this).before(
            '<div class="mt-1 row g-2" id="directorGroup"> <div class="detailsmargin card-header d-flex flex-between-center bg-light py-2"> <h6 class="detailspadding mb-0">Upload documents of Directors</h6> </div> <div class="col-6"> <div class="mb-3"> <label class="form-label" for="bootstrap-wizard-validation-wizard-email">Directors Email</label><input class="form-control" type="email" name="directors[' +
            directorIndex +
            '][email]" placeholder="Email address" pattern="^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$" id="bootstrap-wizard-validation-wizard-email" data-wizard-validate-email="true"> <div class="invalid-feedback">You must add email</div> </div> </div> <div class="col-6"> <div class="mb-3"> <label class="form-label" for="form-wizard-progress-wizard-addregnum">Directors Mobile number registered with aadhar</label><input class="form-control" type="text" name="directors[' +
            directorIndex +
            '][mobile]" maxlength="10" onkeypress="validate(event)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="Enter Registration No" id="form-wizard-progress-wizard-addregnum"> <div class="invalid-feedback">Please provide Mobile number</div> </div> </div> <div class="col-6 mb-3"> <div class="mb-3"> <label>Upload PAN Card  :</label> <!-- required="required"  --> <input type="file" name="directors[' +
            directorIndex +
            '][d_pancard_img][]" id="image-upload" class="myfrm form-control" multiple=""> </div> </div> <div class="col-6 mb-3"> <div class="mb-3"> <label>Upload Aadhar Card  :</label> <!-- required="required"  --> <input type="file" name="directors[' +
            directorIndex +
            '][d_aadharcard_img][]" id="image-upload" class="myfrm form-control" multiple=""> </div> </div> <div class="col-6 mb-3"> <div class="mb-3"> <label>Upload Voter ID Card  Passport  :</label> <!-- required="required"  --> <input type="file" name="directors[' +
            directorIndex +
            '][d_voterid_or_passport_img][]" id="image-upload" class="myfrm form-control" multiple=""> </div> </div> <div class="col-6 mb-3"> <div class="mb-3"> <label>Upload Driving License  :</label> <!-- required="required"  --> <input type="file" name="directors[' +
            directorIndex +
            '][d_drivinglicence_img][]" id="image-upload" class="myfrm form-control" multiple=""> </div> </div> <div class="col-6 mb-3"> <div class="mb-3"> <label>Upload Photograph  :</label> <!-- required="required"  --> <input type="file" name="directors[' +
            directorIndex +
            '][d_userphoto_img][]" id="image-upload" class="myfrm form-control" multiple=""> </div> </div> <div class="mt-1 row g-2"> <button class="deletedirector btn btn-outline-primary me-1 mb-1" type="button"><span class="fas fa-trash me-1" data-fa-transform="shrink-3"></span> Delete Director </button> </div> </div>'
        );
    });

    $(document).on('click', '.deletedirector', function() {
        $(this).parents("#directorGroup").remove();
    });
</script>

<!-- https://stackoverflow.com/questions/29147180/dropzone-js-sends-empty-files -->
