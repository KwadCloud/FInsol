<div class="tab-pane fade" id="labour" role="tabpanel" aria-labelledby="profile-tab">
    <form class="needs-validation" novalidate="novalidate" action="{{ route('labour.register.labour') }}" method="post"
        enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="labour_type" value="Labours" />
        <div class="detailsmargin card-header d-flex flex-between-center bg-light py-2">
            <h6 class="detailspadding mb-0">Details of your Business</h6>
        </div>
        <div class="mt-1 row g-2">

            <!-- to be connected to backend --->

            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label" for="bootstrap-wizard-validation-wizard-company">Name of Labour
                    </label><input class="form-control" type="text" pattern="[a-zA-Z\s]+" name="name_of_labour"
                        placeholder="Name of Labour" required="required" />
                    <div class="invalid-feedback">Please provide name of Labour</div>
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label" for="bootstrap-wizard-validation-wizard-company">Name of
                        Individual/Business
                    </label><input class="form-control" type="text" pattern="[a-zA-Z\s]+" name="name_of_business"
                        placeholder="Name of Individual/Business" required="required" />
                    <div class="invalid-feedback">Please provide name of Individual/Business</div>
                </div>
            </div>

            <!-- to be connected to backend --->

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
                    <select class="form-control" name="registration_type" required>
                        <option value="new" selected>New Registration</option>
                        <option value="renewal">Renewal</option>
                    </select>  
                </div>
            </div>
            <div class="detailsmargin card-header d-flex flex-between-center bg-light py-2">
                <h6 class="detailspadding mb-0">Upload documents of
                    Epf Labours</h6>
            </div>
            <div class="row g-2 ">
                @foreach ($labour_images as $keyname => $image)
                    <div class="col-6 mb-3">
                        <div class="mb-3">
                            <label>{{ $image['doc_name'] }} :</label>
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
