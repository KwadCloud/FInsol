@if ($networthDetails)
    <div class="networthrd mb-3">
        <div class="networthrd-header">
            <h5 class="mb-0">NETWORTH Details</h5>
        </div>
        <div class="networthrd-body bg-light">
            <div class="row">
                <div class="col-lg-6 mb-3"> <label class="form-label" for="gst-type">Name of Compaany :
                    </label>{{ $networthDetails->name }}</div>
                <div class="col-lg-6 mb-3"> <label class="form-label" for="pan-number">Company Number :
                    </label>{{ $networthDetails->company_number }}</div>
                <div class="col-lg-6 mb-3"> <label class="form-label" for="mobile">Mobile :
                    </label>{{ $networthDetails->mobile_number }}</div>
                <div class="col-lg-6 mb-3"> <label class="form-label" for="email1">Email :
                    </label>{{ $networthDetails->email_id }}
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
    @if ($networthDetails->type == 'New Networth Registration')
        <div class="networthrd mb-3">

            <div class="networthrd-header">
                <h5 class="mb-0">Documents</h5>
            </div>
            <div class="networthrd-body bg-light">

                @include('admin.pages.users.certification.profile.common', [
                    'documents' => $networthDocuments,
                    'form_type' => 'Networth',
                    'details' => $networthDetails,
                ])
            </div>

        </div>
    @endif
@endif
