@if ($esicDetails)
    <div class="card mb-3">
        <div class="card-header">
            <h5 class="mb-0">ESIC Details</h5>
        </div>
        <div class="card-body bg-light">
            <div class="row">
                <div class="col-lg-6 mb-3"> <label class="form-label" for="gst-type">Name of Esic :
                    </label>{{ $esicDetails->name_of_esic }}</div>
                <div class="col-lg-6 mb-3"> <label class="form-label" for="pan-number">ESIC Number :
                    </label>{{ $esicDetails->esic_number }}</div>
                <div class="col-lg-6 mb-3"> <label class="form-label" for="mobile">Mobile :
                    </label>{{ $esicDetails->esic_mobile }}</div>
                <div class="col-lg-6 mb-3"> <label class="form-label" for="email1">Email :
                    </label>{{ $esicDetails->esic_email }}
                </div>
                <div class="col-lg-6 mb-3"> <label class="form-label" for="epf_type">ESIC Type :
                    </label>{{ $esicDetails->esic_type }}
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
    @if ($esicDetails->type == 'New ESIC Registration')
        <div class="card mb-3">

            <div class="card-header">
                <h5 class="mb-0">ESIC Documents</h5>
            </div>
            <div class="card-body bg-light">

                @include('admin.pages.users.forms.profile.common', [
                    'documents' => $esicDetails->esic_type == 'Company' ? $esicDocuments : $esicOthersDocuments,
                    'form_type' => $esicDetails->esic_type == 'Company' ? 'Esic/Company' : 'Esic/Others',
                    'details' => $esicDetails,
                ])

            </div>

        </div>
    @endif
    </div>

    @if ($esicSignatory)
        @foreach ($esicSignatory as $index => $sign)
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="mb-0">Signatory {{ $index + 1 }} Details / Documents </h5>
                    <h6><span>Signatory Email :{{ $sign->esic_sign_email }}</span>&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;<span>Signatory Mobile :{{ $sign->esic_sign_mobile }}</span></h6>
                </div>
                <div class="card-body bg-light">
                    @include('admin.pages.users.forms.profile.common', [
                        'documents' => $esicSignatoryDocuments,
                        'form_type' => 'Esic/Company/Signatory',
                        'details' => $sign,
                    ])
                </div>
            </div>
            </div>
            </div>
        @endforeach
    @endif
@endif
