@if ($panDetails)
    <div class="card mb-3">
        <div class="card-header">
            <h5 class="mb-0">PAN Details</h5>
        </div>
        <div class="card-body bg-light">
            <div class="row">
                <div class="col-lg-6 mb-3"> <label class="form-label" for="gst-type">Name of Pan :
                    </label>{{ $panDetails->name_of_pan }}</div>
                <div class="col-lg-6 mb-3"> <label class="form-label" for="pan-number">PAN Number :
                    </label>{{ $panDetails->pan_number }}</div>
                <div class="col-lg-6 mb-3"> <label class="form-label" for="mobile">Mobile :
                    </label>{{ $panDetails->mobile_number }}</div>
                <div class="col-lg-6 mb-3"> <label class="form-label" for="email1">Email :
                    </label>{{ $panDetails->email_id }}
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
    @if ($panDetails->type == 'New PAN Registration')
        <div class="card mb-3">

            <div class="card-header">
                <h5 class="mb-0">PAN Documents</h5>
            </div>
            <div class="card-body bg-light">

                @include('admin.pages.users.forms.profile.common', [
                    'documents' => $panDocuments,
                    'form_type' => 'Pan',
                    'details' => $panDetails,
                ])
            </div>

        </div>
    @endif
@endif
