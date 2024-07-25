@extends('user.layouts.app')
@section('content')
    @php
        $state = App\Models\State::where('id', $user->state)->first()->name;
        $district = App\Models\District::where('d_code', $user->district)->first()->name;
        $block = App\Models\Block::where('id', $user->block)->first()->name;
    @endphp
    <div class="row">
        <div class="col-12">
            <div class="card mb-3 btn-reveal-trigger">
                <div class="card-header position-relative min-vh-25 mb-8">
                    <div class="cover-image">
                        <div class="bg-holder rounded-3 rounded-bottom-0"
                            style="background-image:url({{ url('images/4.jpg') }});"></div>
                    </div>
                    <div class="avatar avatar-5xl avatar-profile shadow-sm img-thumbnail rounded-circle">
                        <div class="h-100 w-100 rounded-circle overflow-hidden position-relative">
                            @if ($user->image == null)
                                <img src="{{ url('images/avatar.png') }}" width="200" alt=""
                                    data-dz-thumbnail="data-dz-thumbnail" />
                            @else
                                <img src="{{ url('uploads/users/' . $user->id . '/profile/' . $user->image) }}"
                                    width="200" alt="" data-dz-thumbnail="data-dz-thumbnail" />
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-0">
        <div class="col-lg-12 pe-lg-2">
            <div class="card mb-3">
                <div class="card-header d-flex align-items-center">
                    <h4 class="mb-0">Profile</h4>
                    <a href="{{ url('change-password') }}" class="btn btn-primary ms-auto">Change Password</a>
                    <a href="{{ url('profile/edit') }}" class="btn btn-primary ms-2">Edit</a>
                </div>
                <div class="card-body bg-light">
                    <h5 class="fs-0 mb-2">
                        Full Name: {{ $user->name }}
                    </h5>
                    <h5 class="fs-0 mb-2">
                        Aadhaar: {{ $user->aadhaar }}
                    </h5>
                    <h5 class="fs-0 mb-2">
                        Mobile: {{ $user->mobile }}
                    </h5>
                    <h5 class="fs-0 mb-2">
                        Email: {{ $user->email }}
                    </h5>
                    <h5 class="fs-0 mb-2">
                        Block: {{ $block }}
                    </h5>
                    <h5 class="fs-0 mb-2">
                        District: {{ $district }}
                    </h5>
                    <h5 class="fs-0 mb-2">
                        State: {{ $state }}
                    </h5>
                </div>
            </div>
        </div>
    </div>
    <!--- add Partner JS  -->
@endsection
