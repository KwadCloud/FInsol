<form class="needs-validation" novalidate="novalidate" action="{{ route('huf.register') }}" method="post"
    enctype="multipart/form-data">
    @csrf

    <div class="detailsmargin card-header d-flex flex-between-center bg-light py-2">
        <h6 class="detailspadding mb-0">Details of your Huf</h6>
    </div>
    <div class="mt-1 row g-2" id="hufdetails">
        <div class="col-6">
            <div class="mb-3">
                <label class="form-label" for="bootstrap-wizard-validation-wizard-company">Name of HUF
                </label><input class="form-control" type="text" pattern="[a-zA-Z\s]+" name="name_of_huf" placeholder="Name of Huf"
                    required="required" />
                <div class="invalid-feedback">Please provide name of HUF</div>
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label class="form-label" for="bootstrap-wizard-validation-wizard-email">
                    Email</label><input class="form-control" type="email" name="huf_email" placeholder="Email address"
                    pattern="^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$" required="required"
                    id="bootstrap-wizard-validation-wizard-email" data-wizard-validate-email="true" />
                <div class="invalid-feedback">You must add email</div>
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label class="form-label" for="bootstrap-wizard-validation-wizard-company">Name of Karta
                </label><input class="form-control" type="text" pattern="[a-zA-Z\s]+" name="name_of_karta" placeholder="Name of Karta"
                    required="required" />
                <div class="invalid-feedback">Please provide name of Karta</div>
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label class="form-label" for="form-wizard-progress-wizard-addregnum">
                    Mobile number
                </label><input class="form-control" type="text" name="huf_mobile" onkeypress="validate(event)"
                    oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                    maxlength="10" required="required" maxlength="10" placeholder="Enter Mobile No"
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

    <div class="detailsmargin card-header d-flex flex-between-center bg-light py-2">
        <h6 class="detailspadding mb-0">Upload documents of Member</h6>
    </div>

    <div class="mt-1 row g-2" id="hufmemberGroup">
        <div class="col-6">
            <div class="mb-3">
                <label class="form-label" for="bootstrap-wizard-validation-wizard-company">Name of Member
                </label><input class="form-control" type="text" name="hufmember[0][name_of_member]"
                    placeholder="Name of Member" required="required" />
                <div class="invalid-feedback">Please provide name of Member</div>
            </div>
        </div>

        @foreach ($huf_member_images as $keyname => $image)
            <div class="col-4 mb-3">
                <div class="mb-3">
                    <label>{{ $image['doc_name'] }} :</label>
                    <input type="file" name="hufmember[0][{{ $image['doc_key_name'] }}][]" id="image-upload"
                        class="myfrm form-control" multiple />
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-1 row g-2">
        <button class="addhufmember btn btn-primary me-1 mb-1" type="button">
            <span class="fas fa-plus me-1" data-fa-transform="shrink-3"></span>Add Member
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
    var hufmemberIndex = 0;
    $('.addhufmember').click(function() {
        hufmemberIndex++;

        var html =
            '<div class="mt-1 row g-2" id="hufmemberGroup" style=" white-space: nowrap;"> <div class="col-6"> <div class="mb-3"> <label class="form-label" for="bootstrap-wizard-validation-wizard-company">Name of Member </label><input class="form-control" type="text" name="hufmember[' +
            hufmemberIndex +
            '][name_of_member]" placeholder="Name of Member" required="required"> <div class="invalid-feedback">Please provide name of Member</div></div></div><div class="col-4 mb-3"> <div class="mb-3"> <label>KYC of Member :</label> <input type="file" name="hufmember[' +
            hufmemberIndex +
            '][kyc_of_member_img][]" id="image-upload" class="myfrm form-control" multiple=""> </div></div>';
        html +=
            '<div class="mt-1 row g-2"><button class="deletehufmember btn btn-outline-primary me-1 mb-1" type="button"><span class="fas fa-trash me-1" data-fa-transform="shrink-3"></span> Delete Member</button> </div></div>';
        $(this).before(html);
    });

    $(document).on('click', '.deletehufmember', function() {
        $(this).parents("#hufmemberGroup").remove();
    });
</script>
