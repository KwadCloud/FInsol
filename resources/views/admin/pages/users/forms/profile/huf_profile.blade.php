@if ($hufDetails)

    <div class="card mb-3">
        <div class="card-header">
            <h5 class="mb-0">HUF Details</h5>
        </div>
        <div class="card-body bg-light">
            <div class="row">
                <div class="col-lg-6 mb-3"> <label class="form-label" for="gst-type">Name of Huf :
                    </label>{{ $hufDetails->name_of_huf }}</div>
                <div class="col-lg-6 mb-3"> <label class="form-label" for="pan-number">HUF Number :
                    </label>{{ $hufDetails->huf_number }}</div>
                <div class="col-lg-6 mb-3"> <label class="form-label" for="mobile">Mobile :
                    </label>{{ $hufDetails->huf_mobile }}</div>
                <div class="col-lg-6 mb-3"> <label class="form-label" for="email1">Email :
                    </label>{{ $hufDetails->huf_email }}</div>
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

    <div class="card mb-3">
        @if ($hufDetails->type == 'New HUF Registration')
        @endif
    </div>

    @if ($hufMember)
        @foreach ($hufMember as $index => $dir)
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="mb-0">Member {{ $index + 1 }} Details / Documents </h5>
                    <h6><span>Member Name :{{ $dir->name_of_member }}</span>&nbsp;&nbsp;&nbsp;
                        </span></h6>
                </div>
                <div class="card-body bg-light">
                    @include('admin.pages.users.forms.profile.common', [
                        'documents' => $hufMemberDocuments,
                        'form_type' => 'Huf/Member',
                        'details' => $dir,
                    ])
                </div>
            </div>
            </div>
            </div>
        @endforeach
    @endif
@endif
