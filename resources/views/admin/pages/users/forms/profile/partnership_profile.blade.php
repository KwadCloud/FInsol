@if ($partnershipDetails)
    <div class="card mb-3">
        <div class="card-header">
            <h5 class="mb-0">PARTNERSHIP Details</h5>
        </div>
        <div class="card-body bg-light">
            <div class="row">
                <div class="col-lg-6 mb-3"> <label class="form-label" for="gst-type">Name of Partnership :
                    </label>{{ $partnershipDetails->name_of_partnership }}</div>
                <div class="col-lg-6 mb-3"> <label class="form-label" for="pan-number">PARTNERSHIP Number :
                    </label>{{ $partnershipDetails->partnership_number }}</div>
                <div class="col-lg-6 mb-3"> <label class="form-label" for="mobile">Mobile :
                    </label>{{ $partnershipDetails->partnership_mobile }}</div>
                <div class="col-lg-6 mb-3"> <label class="form-label" for="email1">Email :
                    </label>{{ $partnershipDetails->partnership_email }}</div>
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

    @if ($partnershipDetails->type == 'New Partnership Registration')
        <div class="card mb-3">

            <div class="card-header">
                <h5 class="mb-0">PARTNERSHIP Documents</h5>
            </div>
            <div class="card-body bg-light">
                @include('admin.pages.users.forms.profile.common', [
                    'documents' => $partnershipDocuments,
                    'form_type' => 'Partnership',
                    'details' => $partnershipDetails,
                ])

            </div>

        </div>
    @endif
    </div>

    @if ($partnershipPartner)
        @foreach ($partnershipPartner as $index => $dir)
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="mb-0">Partner {{ $index + 1 }} Details / Documents </h5>
                    <h6><span>Partner Email :{{ $dir->partner_email }}</span>&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;<span>Partner Mobile :{{ $dir->partner_mobile }}</span></h6>
                </div>
                <div class="card-body bg-light">
                    @include('admin.pages.users.forms.profile.common', [
                        'documents' => $partnershipPartnerDocuments,
                        'form_type' => 'Partnership/Partner',
                        'details' => $dir,
                    ])
                </div>
            </div>
            </div>
            </div>
        @endforeach
    @endif
@endif
