@if ($importexportDetails)
    <div class="card mb-3">
        <div class="card-header">
            <h5 class="mb-0">IMPORTEXPORT Details</h5>
        </div>
        <div class="card-body bg-light">
            <div class="row">
                <div class="col-lg-6 mb-3"> <label class="form-label" for="gst-type">Name of Firm :
                    </label>{{ $importexportDetails->name_of_firm }}</div>
                <div class="col-lg-6 mb-3"> <label class="form-label" for="importexport-number">Firm Number :
                    </label>{{ $importexportDetails->firm_number }}</div>
                <div class="col-lg-6 mb-3"> <label class="form-label" for="mobile">Mobile :
                    </label>{{ $importexportDetails->firm_mobile }}</div>
                <div class="col-lg-6 mb-3"> <label class="form-label" for="email1">Email :
                    </label>{{ $importexportDetails->firm_email }}</div>
            </div>
        </div>
    </div>
    @if (session('filenotexistsection1'))
        <div class="alert alert-danger border-2 d-flex align-items-center" role="alert">
            <div class="bg-danger me-3 icon-item">
                <simportexport class="fas fa-check-circle text-white fs-3"></simportexport>
            </div>
            <p class="mb-0 flex-1">{{ session('filenotexistsection1') }}</p>
            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if ($importexportDetails->type == 'New ImportExport Registration')
        <div class="card mb-3">

            <div class="card-header">
                <h5 class="mb-0">IMPORTEXPORT Documents</h5>
            </div>
            <div class="card-body bg-light">

                @include('admin.pages.users.forms.profile.common', [
                    'documents' => $importexportDocuments,
                    'form_type' => 'ImportExport',
                    'details' => $importexportDetails,
                ])

            </div>

        </div>
    @endif
    </div>

@endif
