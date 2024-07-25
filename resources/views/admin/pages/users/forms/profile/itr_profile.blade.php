@if ($itrDetails)

    <div class="card mb-3">
        <div class="card-header">
            <h5 class="mb-0">ITR Details</h5>
        </div>
        <div class="card-body bg-light">
            <div class="row">
                <div class="col-lg-6 mb-3"> <label class="form-label" for="gst-type">Name of Itr :
                    </label>{{ $itrDetails->name_of_itr }}</div>
                <div class="col-lg-6 mb-3"> <label class="form-label" for="pan-number">ITR Number :
                    </label>{{ $itrDetails->itr_number }}</div>
                <div class="col-lg-6 mb-3"> <label class="form-label" for="mobile">Mobile :
                    </label>{{ $itrDetails->mobile_number }}</div>
                <div class="col-lg-6 mb-3"> <label class="form-label" for="email1">Email :
                    </label>{{ $itrDetails->email_id }}</div>
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
    @if ($itrDetails->type == 'New ITR Registration')
        <div class="card mb-3">

            <div class="card-header">
                <h5 class="mb-0">ITR Documents</h5>
            </div>
            <div class="card-body bg-light">

                @include('admin.pages.users.forms.profile.common', [
                    'documents' => $itrDocuments,
                    'form_type' => 'Itr',
                    'details' => $itrDetails,
                ])

            </div>

        </div>
    @endif
    </div>

@endif
