<div class="tab-pane fade" id="pill-tab-profile" role="tabpanel" aria-labelledby="profile-tab">
    <form class="needs-validation" novalidate="novalidate" action="{{ route('gst.uploaddocumentscreate') }}"
        method="post"enctype="multipart/form-data">
        @csrf
        <div class="detailsmargin card-header d-flex flex-between-center bg-light py-2">
            <h6 class="detailspadding mb-0">Select Business</h6>
        </div>
        <div class="mt-1 row g-2">
            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label" for="form-wizard-progress-wizard-legalnamename">Select
                        GST Number</label>
                    <select name="gstnumber" class="form-select" id="gstSelect2" required="required"
                        onChange="getTradeName2()" aria-label="Default select example">
                        <option value="">GST Number</option>
                        @foreach ($gstNumbers as $key => $numbers)
                            <option value="{{ $numbers->gst_number }}">{{ $numbers->gst_number }}</option>
                        @endforeach
                    </select>

                    <input type="hidden" name="doc_type" value="Quarterly" />
                    <div class="invalid-feedback">Please select GST Number</div>
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label" for="form-wizard-progress-wizard-legalnamename">Trade
                        Name of
                        the
                        Business</label><input required="" class="form-control tradeName2" type="text" disabled
                        name="name" placeholder="Legal Name of Business" id="form-wizard-progress-wizard-legalname"
                        data-wizard-validate-legal-name="true" />
                    <div class="invalid-feedback">Please provide Trade Name</div>
                </div>
            </div>
            <div class="detailsmargin card-header d-flex flex-between-center bg-light py-2">
                <h6 class="detailspadding mb-0">Select Year and Month</h6>
            </div>
        </div>
        <div class="mt-1 row g-2">
            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label" for="form-wizard-progress-wizard-legalnamename">Select
                        Year</label>
                    <select class="form-select" required="required" name="year" aria-label="Default select example">
                        @php
                            $currentYear = date('Y');
                            $startYear = $currentYear - 20;
                            $endYear = $currentYear;
                        @endphp
                        <option value="">Select Year</option>
                        @for ($year = $endYear; $year >= $startYear; $year--)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endfor
                    </select>
                    <div class="invalid-feedback">Please select Year</div>
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label" for="form-wizard-progress-wizard-legalnamename">Select
                        Quarter</label>

                    <select class="form-select" required="required" name="quarter">
                        <option value="">Select Quarter</option>

                        <option value="{{ 'January-March' }}">{{ 'January-March' }}</option>
                        <option value="{{ 'April-June' }}">{{ 'April-June' }}</option>
                        <option value="{{ 'July-September' }}">{{ 'July-September' }}</option>
                        <option value="{{ 'October-December' }}">{{ 'October-December' }}</option>
                    </select>

                    <div class="invalid-feedback">Please select Quarter</div>
                </div>
            </div>
            <div class="detailsmargin card-header d-flex flex-between-center bg-light py-2">
                <h6 class="detailspadding mb-0">Upload documents to file returns</h6>
            </div>
            <div class="col-12">
                <input type="file" name="documents[]" required="required" class="form-control" multiple />

            </div>
            <div class="col-4"></div>
            <div class="col-4">
                <div class="mb-3">
                    <button class="mt-4 btn btn-primary me-1 mb-1" type="submit">Upload Quarter Documents</button>
                </div>
            </div>
            <div class="col-4"></div>
        </div>
    </form>
</div>
