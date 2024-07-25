@if ($labourDetails)

    <div class="card mb-3">
        <div class="card-header">
            <h5 class="mb-0">LABOUR Details</h5>
        </div>
        <div class="card-body bg-light">
            <div class="row">
                <div class="col-lg-6 mb-3"> <label class="form-label" for="gst-type">Name of Labour :
                    </label>{{ $labourDetails->name_of_labour }}</div>
                    <div class="col-lg-6 mb-3"> <label class="form-label" for="business">Name of Individual/Business :
                    </label>{{ $labourDetails->name_of_business }}</div>
                <div class="col-lg-6 mb-3"> <label class="form-label" for="pan-number">LABOUR Number :
                    </label>{{ $labourDetails->labour_number }}</div>
                <div class="col-lg-6 mb-3"> <label class="form-label" for="mobile">Mobile :
                    </label>{{ $labourDetails->labour_mobile }}</div>
                <div class="col-lg-6 mb-3"> <label class="form-label" for="email1">Email :
                    </label>{{ $labourDetails->labour_email }}</div>
                    <div class="col-lg-6 mb-3"> <label class="form-label" for="type">Type :
                    </label>{{ $labourDetails->labour_type == 'Company' ? 'Petty Contractor' : 'Labour Contract' }}</div>
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
    @if ($labourDetails->type == 'New Labour Registration')
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="mb-0">LABOUR Documents</h5>
            </div>
            <div class="card-body bg-light">
                @include('admin.pages.users.forms.profile.common', [
                    'documents' =>
                        $labourDetails->labour_type == 'Company' ? $labourDocuments : $labourOthersDocuments,
                    'form_type' => $labourDetails->labour_type == 'Company' ? 'Labour/Petty' : 'Labour/Labour',
                    'details' => $labourDetails,
                ])
            </div>
        </div>
    @endif
    </div>

    @if ($labourSignatory)
        @foreach ($labourSignatory as $index => $sign)
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="mb-0">Signatory {{ $index + 1 }} Details / Documents </h5>
                    <h6><span>Signatory Email :{{ $sign->labour_sign_email }}</span>&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;<span>Signatory Mobile :{{ $sign->labour_sign_mobile }}</span></h6>
                </div>
                <div class="card-body bg-light">
                    @include('admin.pages.users.forms.profile.common', [
                        'documents' => $labourSignatoryDocuments,
                        'form_type' => 'Labour/Petty/Signatory',
                        'details' => $sign,
                    ])
                </div>
            </div>
            </div>
        @endforeach
    @endif
@endif
