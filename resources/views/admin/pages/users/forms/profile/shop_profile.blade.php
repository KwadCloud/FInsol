@if ($shopDetails)

    <div class="card mb-3">
        <div class="card-header">
            <h5 class="mb-0">SHOP Details</h5>
        </div>
        <div class="card-body bg-light">
            <div class="row">
                <div class="col-lg-6 mb-3"> <label class="form-label" for="gst-type">Name of Shop :
                    </label>{{ $shopDetails->name_of_shop }}</div>
                <div class="col-lg-6 mb-3"> <label class="form-label" for="pan-number">SHOP Number :
                    </label>{{ $shopDetails->shop_number }}</div>
                <div class="col-lg-6 mb-3"> <label class="form-label" for="mobile">Mobile :
                    </label>{{ $shopDetails->mobile_number }}</div>
                <div class="col-lg-6 mb-3"> <label class="form-label" for="email1">Email :
                    </label>{{ $shopDetails->email_id }}</div>
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
    @if ($shopDetails->type == 'New SHOP Registration')
        <div class="card mb-3">

            <div class="card-header">
                <h5 class="mb-0">SHOP Documents</h5>
            </div>
            <div class="card-body bg-light">

                @include('admin.pages.users.forms.profile.common', [
                    'documents' => $shopDocuments,
                    'form_type' => 'Shop',
                    'details' => $shopDetails,
                ])

            </div>

        </div>
    @endif
    </div>

@endif
