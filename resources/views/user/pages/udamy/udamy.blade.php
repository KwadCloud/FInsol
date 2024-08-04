<div class="row g-0">
    <div class="col-xl-12">
        <div class="card mb-3">
            <!-- <div class="card-header">
                             <h6 class="mb-0">Get yourself a New PAN Card</h6>
                        </div> -->
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success border-2 d-flex align-items-center" role="alert">
                        <div class="bg-success me-3 icon-item"><span class="fas fa-check-circle text-white fs-3"></span>
                        </div>
                        <p class="mb-0 flex-1">{{ session('success') }}</p>
                        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <form class="needs-validation" novalidate="novalidate" action="{{ route('udamy.register') }}"
                    method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="detailsmargin card-header d-flex flex-between-center bg-light py-2">
                        <h6 class="detailspadding mb-0">Personal Details</h6>
                    </div>
                    <div class="mt-1 row g-2">

                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label" for="bootstrap-wizard-validation-wizard-company">Name of
                                    Business
                                </label><input class="form-control" type="text" pattern="[a-zA-Z\s]+" name="name_of_udamy"
                                    placeholder="Name of Business" required="required" />
                                <div class="invalid-feedback">Please provide name of Business</div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label" for="bootstrap-wizard-validation-wizard-email">Email ID
                                </label><input class="form-control" type="email" name="udamy_email"
                                    placeholder="Email address"
                                    pattern="^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$"
                                    required="required" id="bootstrap-wizard-validation-wizard-email"
                                    data-wizard-validate-email="true" />
                                <div class="invalid-feedback">You must add email</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label" for="form-wizard-progress-wizard-addregnum">Mobile
                                    Number linked with Aadhar</label><input class="form-control" required=""
                                    type="text" name="udamy_mobile" placeholder="Mobile No"
                                    onkeypress="validate(event)"
                                    oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                    maxlength="10" id="form-wizard-progress-wizard-addregnum" />
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
                            <h6 class="detailspadding mb-0">Upload documents required for Udyam Registration
                            </h6>
                        </div>
                        <div class="row g-2 ">
                            @foreach ($udamy_images as $keyname => $image)
                                <div class="col-6 mb-3">
                                    <div class="mb-3">
                                        <label>{{ $image['doc_name'] }} :</label>
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
        </div>
    </div>
</div>
