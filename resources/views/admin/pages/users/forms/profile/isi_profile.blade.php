@if ($isiDetails)
    <div class="card mb-3">
        <div class="card-header">
            <h5 class="mb-0">ISI Details</h5>
        </div>
        <div class="card-body bg-light">
            <div class="row">
                <div class="col-lg-6 mb-3"> <label class="form-label" for="gst-type">Name of Company :
                    </label>{{ $isiDetails->name_of_company }}</div>
                <div class="col-lg-6 mb-3"> <label class="form-label" for="mobile">Mobile :
                    </label>{{ $isiDetails->mobile_number }}</div>
                <div class="col-lg-6 mb-3"> <label class="form-label" for="email1">Email :
                    </label>{{ $isiDetails->email_id }}</div>
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
    @if ($isiDetails->type == 'New ISI Registration')
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="mb-0">ISI Documents</h5>
            </div>
            <div class="card-body bg-light">
                @include('admin.pages.users.forms.profile.common', [
                    'documents' => $isiDocuments,
                    'form_type' => 'ISI',
                    'details' => $isiDetails,
                ])
            </div>
        </div>
    @endif
    </div>
@endif
