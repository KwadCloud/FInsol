@if ($trustDetails)

    <div class="card mb-3">
        <div class="card-header">
            <h5 class="mb-0">TRUST Details</h5>
        </div>
        <div class="card-body bg-light">
            <div class="row">
                <div class="col-lg-6 mb-3">
                    <label class="form-label" for="gst-type">Name of Trust : </label>{{ $trustDetails->name_of_trust }}
                </div>
                <div class="col-lg-6 mb-3">
                    <label class="form-label" for="pan-number">TRUST Number : </label>{{ $trustDetails->trust_number }}
                </div>
                <div class="col-lg-6 mb-3">
                    <label class="form-label" for="mobile">Mobile : </label>{{ $trustDetails->trust_mobile }}
                </div>
                <div class="col-lg-6 mb-3">
                    <label class="form-label" for="email1">Email : </label>{{ $trustDetails->trust_email }}
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

    @if ($trustDetails->type == 'New Trust Registration')
        <div class="card mb-3">

            <div class="card-header">
                <h5 class="mb-0">TRUST Documents</h5>
            </div>
            <div class="card-body bg-light">
                @include('admin.pages.users.forms.profile.common', [
                    'documents' => $trustDocuments,
                    'form_type' => 'Trust',
                    'details' => $trustDetails,
                ])

            </div>
    @endif
    </div>

    @if ($trustMember)
        @foreach ($trustMember as $index => $dir)
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="mb-0">Member {{ $index + 1 }} Details / Documents </h5>
                    <h6><span>Member Name :{{ $dir->name_of_member }}</span>&nbsp;&nbsp;&nbsp;
                    </h6>
                </div>
                <div class="card-body bg-light">
                    @include('admin.pages.users.forms.profile.common', [
                        'documents' => $trustMemberDocuments,
                        'form_type' => 'Trust/Member',
                        'details' => $dir,
                    ])
                </div>
            </div>
            </div>
            </div>
        @endforeach
    @endif
@endif
