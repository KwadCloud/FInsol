@if ($epfDetails)
    <div class="card mb-3">
        <div class="card-header">
            <h5 class="mb-0">EPF Details</h5>
        </div>
        <div class="card-body bg-light">
            <div class="row">
                <div class="col-lg-6 mb-3"> <label class="form-label" for="gst-type">Name of Epf :
                    </label>{{ $epfDetails->name_of_epf }}</div>
                <div class="col-lg-6 mb-3"> <label class="form-label" for="pan-number">EPF Number :
                    </label>{{ $epfDetails->epf_number }}</div>
                <div class="col-lg-6 mb-3"> <label class="form-label" for="mobile">Mobile :
                    </label>{{ $epfDetails->epf_mobile }}
                </div>
                <div class="col-lg-6 mb-3"> <label class="form-label" for="email1">Email :
                    </label>{{ $epfDetails->epf_email }}
                </div>
                <div class="col-lg-6 mb-3"> <label class="form-label" for="epf_type">EPF Type :
                    </label>{{ $epfDetails->epf_type }}
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
    @if ($epfDetails->type == 'New EPF Registration')
        <div class="card mb-3">

            <div class="card-header">
                <h5 class="mb-0">EPF Documents</h5>
            </div>
            <div class="card-body bg-light">
                @include('admin.pages.users.forms.profile.common', [
                    'documents' => $epfDetails->epf_type == 'Company' ? $epfDocuments : $epfOtherDocuments,
                    'form_type' => 'Epf/' . $epfDetails['epf_type'],
                    'details' => $epfDetails,
                ])

            </div>

        </div>
    @endif
    </div>

    @if ($epfSignatory)
        @foreach ($epfSignatory as $index => $sign)
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="mb-0">Signatory {{ $index + 1 }} Details / Documents </h5>
                    <h6><span>Signatory Email :{{ $sign->epf_sign_email }}</span>&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;<span>Signatory Mobile :{{ $sign->epf_sign_mobile }}</span></h6>
                </div>
                <div class="card-body bg-light">
                    @include('admin.pages.users.forms.profile.common', [
                        'documents' => $epfSignatoryDocuments,
                        'form_type' => 'Epf/' . $epfDetails['epf_type'] . '/Signatory/',
                        'details' => $sign,
                    ])
                </div>
            </div>
            </div>
            </div>
        @endforeach
    @endif
@endif
