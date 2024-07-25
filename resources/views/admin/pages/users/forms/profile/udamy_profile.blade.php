@if ($udamyDetails)
    <div class="card mb-3">
        <div class="card-header">
            <h5 class="mb-0">Udyam Details</h5>
        </div>
        <div class="card-body bg-light">
            <div class="row">
                <div class="col-lg-6 mb-3"> <label class="form-label" for="gst-type">Name of Udyam :
                    </label>{{ $udamyDetails->name_of_udamy }}</div>
                <div class="col-lg-6 mb-3"> <label class="form-label" for="udamy-number">Udyam Number :
                    </label>{{ $udamyDetails->udamy_number }}</div>
                <div class="col-lg-6 mb-3"> <label class="form-label" for="mobile">Mobile :
                    </label>{{ $udamyDetails->udamy_mobile }}</div>
                <div class="col-lg-6 mb-3"> <label class="form-label" for="email1">Email :
                    </label>{{ $udamyDetails->udamy_email }}
                </div>
            </div>
        </div>
    </div>
    @if (session('filenotexistsection1'))
        <div class="alert alert-danger border-2 d-flex align-items-center" role="alert">
            <div class="bg-danger me-3 icon-item">
                <sudamy class="fas fa-check-circle text-white fs-3"></sudamy>
            </div>
            <p class="mb-0 flex-1">{{ session('filenotexistsection1') }}</p>
            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if ($udamyDetails->type == 'New Udamy Registration')
        <div class="card mb-3">

            <div class="card-header">
                <h5 class="mb-0">Udyam Documents</h5>
            </div>
            <div class="card-body bg-light">

                @include('admin.pages.users.forms.profile.common', [
                    'documents' => $udamyDocuments,
                    'form_type' => 'Udamy',
                    'details' => $udamyDetails,
                ])

            </div>

        </div>
    @endif
    </div>
@endif
