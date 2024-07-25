@if ($companyDetails)

    <div class="card mb-3">
        <div class="card-header">
            <h5 class="mb-0">COMPANY Details</h5>
        </div>
        <div class="card-body bg-light">
            <div class="row">
                <div class="col-lg-6 mb-3"> <label class="form-label" for="gst-type">Name of Company :
                    </label>{{ $companyDetails->name_of_company }}</div>
                <div class="col-lg-6 mb-3"> <label class="form-label" for="pan-number">COMPANY Number :
                    </label>{{ $companyDetails->company_number }}</div>
                <div class="col-lg-6 mb-3"> <label class="form-label" for="mobile">Mobile :
                    </label>{{ $companyDetails->company_mobile }}</div>
                <div class="col-lg-6 mb-3"> <label class="form-label" for="email1">Email :
                    </label>{{ $companyDetails->company_email }}</div>
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
    @if ($companyDetails->type == 'New Company Registration')
        <div class="card mb-3">

            <div class="card-header">
                <h5 class="mb-0">COMPANY Documents</h5>
            </div>
            <div class="card-body bg-light">
                @include('admin.pages.users.forms.profile.common', [
                    'documents' => $companyDocuments,
                    'form_type' => 'Company',
                    'details' => $companyDetails,
                ])

            </div>

        </div>
    @endif
    </div>

    @if ($companyDirector)
        @foreach ($companyDirector as $index => $dir)
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="mb-0">Director {{ $index + 1 }} Details / Documents </h5>
                    <h6><span>Director Email :{{ $dir->comp_sign_email }}</span>&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;<span>Director Mobile :{{ $dir->comp_sign_mobile }}</span></h6>
                </div>
                <div class="card-body bg-light">
                    @include('admin.pages.users.forms.profile.common', [
                        'documents' => $companyDirectorDocuments,
                        'form_type' => 'Company/Signatory',
                        'details' => $dir,
                    ])
                </div>
            </div>
            </div>
        @endforeach
    @endif
@endif
