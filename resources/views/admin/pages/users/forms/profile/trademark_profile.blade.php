@if ($trademarkDetails)
    <div class="card mb-3">
        <div class="card-header">
            <h5 class="mb-0">TRADEMARK Details</h5>
        </div>
        <div class="card-body bg-light">
            <div class="row">
                <div class="col-lg-6 mb-3"> <label class="form-label" for="gst-type">Name of Trademark :
                    </label>{{ $trademarkDetails->name_of_trademark }}</div>
                <div class="col-lg-6 mb-3"> <label class="form-label" for="pan-number">TRADEMARK Number :
                    </label>{{ $trademarkDetails->trademark_number }}</div>
                <div class="col-lg-6 mb-3"> <label class="form-label" for="mobile">Mobile :
                    </label>{{ $trademarkDetails->trademark_mobile }}</div>
                <div class="col-lg-6 mb-3"> <label class="form-label" for="email1">Email :
                    </label>{{ $trademarkDetails->trademark_email }}</div>
                    <div class="col-lg-6 mb-3"> <label class="form-label" for="type">Type :
                    </label>{{ $trademarkDetails->trademark_type }}</div>
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
    @if ($trademarkDetails->type == 'New Trademark Registration')
        <div class="card mb-3">

            <div class="card-header">
                <h5 class="mb-0">TRADEMARK Documents</h5>
            </div>
            <div class="card-body bg-light">

                @include('admin.pages.users.forms.profile.common', [
                    'documents' => $trademarkDetails->trademark_type == 'Company' ? $trademarkDocuments : $trademarkOthersDocuments,
                    'form_type' => $trademarkDetails->trademark_type == 'Company' ? 'Trademark/Company' : 'Trademark/Others',
                    'details' => $trademarkDetails,
                ])

            </div>

        </div>
    @endif
    </div>

    @if ($trademarkSignatory)
        @foreach ($trademarkSignatory as $index => $sign)
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="mb-0">Signatory {{ $index + 1 }} Details / Documents </h5>
                    <h6><span>Signatory Email :{{ $sign->trademark_sign_email }}</span>&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;<span>Signatory Mobile :{{ $sign->trademark_sign_mobile }}</span></h6>
                </div>
                <div class="card-body bg-light">
                    @include('admin.pages.users.forms.profile.common', [
                        'documents' => $trademarkSignatoryDocuments,
                        'form_type' => 'Trademark/Company/Signatory',
                        'details' => $sign,
                    ])
                </div>
            </div>
            </div>
            </div>
        @endforeach
    @endif
@endif
