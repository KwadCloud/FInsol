@if ($turnoverDetails)
    <div class="turnoverrd mb-3">
        <div class="turnoverrd-header">
            <h5 class="mb-0">TURNOVER Details</h5>
        </div>
        <div class="turnoverrd-body bg-light">
            <div class="row">
                <div class="col-lg-6 mb-3"> <label class="form-label" for="gst-type">Name of Compaany :
                    </label>{{ $turnoverDetails->name }}</div>
                <div class="col-lg-6 mb-3"> <label class="form-label" for="pan-number">Company Number :
                    </label>{{ $turnoverDetails->company_number }}</div>
                <div class="col-lg-6 mb-3"> <label class="form-label" for="mobile">Mobile :
                    </label>{{ $turnoverDetails->mobile_number }}</div>
                <div class="col-lg-6 mb-3"> <label class="form-label" for="email1">Email :
                    </label>{{ $turnoverDetails->email_id }}
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
    @if ($turnoverDetails->type == 'New Turnover Registration')
        <div class="turnoverrd mb-3">

            <div class="turnoverrd-header">
                <h5 class="mb-0">Documents</h5>
            </div>
            <div class="turnoverrd-body bg-light">

                @include('admin.pages.users.certification.profile.common', [
                    'documents' => $turnoverDocuments,
                    'form_type' => 'Turnover',
                    'details' => $turnoverDetails,
                ])
            </div>

        </div>
    @endif
@endif
