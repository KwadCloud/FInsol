@if ($factorylicenseDetails)
    <div class="card mb-3">
        <div class="card-header">
            <h5 class="mb-0">FACTORY LICENSE Details</h5>
        </div>
        <div class="card-body bg-light">
            <div class="row">
                <div class="col-lg-6 mb-3"> <label class="form-label" for="gst-type">Name of Firm :
                    </label>{{ $factorylicenseDetails->name_of_facl }}</div>
                <div class="col-lg-6 mb-3"> <label class="form-label" for="factorylicense-number">Firm Number :
                    </label>{{ $factorylicenseDetails->facl_number }}</div>
                <div class="col-lg-6 mb-3"> <label class="form-label" for="mobile">Mobile :
                    </label>{{ $factorylicenseDetails->facl_mobile }}</div>
                <div class="col-lg-6 mb-3"> <label class="form-label" for="email1">Email :
                    </label>{{ $factorylicenseDetails->facl_email }}</div>
            </div>
        </div>
    </div>
    @if (session('filenotexistsection1'))
        <div class="alert alert-danger border-2 d-flex align-items-center" role="alert">
            <div class="bg-danger me-3 icon-item">
                <sfactorylicense class="fas fa-check-circle text-white fs-3"></sfactorylicense>
            </div>
            <p class="mb-0 flex-1">{{ session('filenotexistsection1') }}</p>
            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if ($factorylicenseDetails->type == 'New FactoryLicense Registration')
        <div class="card mb-3">

            <div class="card-header">
                <h5 class="mb-0">FACTORY LICENSE Documents</h5>
            </div>
            <div class="card-body bg-light">

                @include('admin.pages.users.forms.profile.common', [
                    'documents' => $factorylicenseDocuments,
                    'form_type' => 'FactoryLicense',
                    'details' => $factorylicenseDetails,
                ])
            </div>
        </div>
    @endif
    </div>
@endif
