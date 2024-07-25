@if ($tdsDetails)

    <div class="card mb-3">
        <div class="card-header">
            <h5 class="mb-0">TDS Details</h5>
        </div>
        <div class="card-body bg-light">
            <div class="row">
                <div class="col-lg-6 mb-3"> <label class="form-label" for="gst-type">Name of Tds :
                    </label>{{ $tdsDetails->name_of_tds }}</div>
                <div class="col-lg-6 mb-3"> <label class="form-label" for="pan-number">TDS Number :
                    </label>{{ $tdsDetails->tds_number }}</div>
                <div class="col-lg-6 mb-3"> <label class="form-label" for="mobile">Mobile :
                    </label>{{ $tdsDetails->mobile_number }}</div>
                <div class="col-lg-6 mb-3"> <label class="form-label" for="email1">Email :
                    </label>{{ $tdsDetails->email_id }}</div>
                <div class="col-lg-6 mb-3"> <label class="form-label" for="email1">Section :
                    </label>{{ $tdsDetails->section }}</div>
                <div class="col-lg-6 mb-3"> <label class="form-label" for="email1">TDS Date :
                    </label>{{ $tdsDetails->tds_date }}</div>
                <div class="col-lg-6 mb-3"> <label class="form-label" for="email1">TDS Rate :
                    </label>{{ $tdsDetails->tds_rate }}%</div>
                <div class="col-lg-6 mb-3"> <label class="form-label" for="email1">TDS Amount :
                    </label>{{ $tdsDetails->tds_amount }}</div>
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

    @if ($tdsDetails->type == 'New TDS Registration')
        <div class="card mb-3">

            <div class="card-header">
                <h5 class="mb-0">TDS Documents</h5>
            </div>
            <div class="card-body bg-light">
                @include('admin.pages.users.forms.profile.common', [
                    'documents' => $tdsDocuments,
                    'form_type' => 'Tds',
                    'details' => $tdsDetails,
                ])

            </div>

        </div>
    @endif
    </div>

@endif
