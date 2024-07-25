@if ($estimatedDetails)
    <div class="networthrd mb-3">
        <div class="networthrd-header">
            <h5 class="mb-0">Estimated Details</h5>
        </div>
        <div class="networthrd-body bg-light">
            <div class="row">
                <div class="col-lg-6 mb-3"> <label class="form-label" for="gst-type">Name of Compaany :
                    </label>{{ $estimatedDetails->name_of_company }}</div>
                <div class="col-lg-6 mb-3"> <label class="form-label" for="pan-number">Company Number :
                    </label>{{ $estimatedDetails->company_number }}</div>
                <div class="col-lg-6 mb-3"> <label class="form-label" for="mobile">Mobile :
                    </label>{{ $estimatedDetails->mobile_number }}</div>
                <div class="col-lg-6 mb-3"> <label class="form-label" for="email1">Email :
                    </label>{{ $estimatedDetails->email_id }}
                </div>
            </div>
        </div>
    </div>
    @if (session('filenotexistsection1'))
        <div class="alert alert-danger border-2 d-flex align-items-center" role="alert">
            <div class="bg-danger me-3 icon-item"><span class="fas fa-check-circle text-white fs-3"></span>
            </div>
            <p class="mb-0 flex-1">{{ session('filenotexistsection1') }}</p>
            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if ($estimatedDetails->type == 'New Loan Estimated Registration')
        <div class="networthrd mb-3">

            <div class="networthrd-header">
                <h5 class="mb-0">Documents</h5>
            </div>
            <div class="networthrd-body bg-light">

                @include('admin.pages.users.loan.profile.common', [
                    'documents' => $estimatedDocuments,
                    'form_type' => 'LFEstimated',
                    'details' => $estimatedDetails,
                ])
            </div>

        </div>
    @endif
@endif
