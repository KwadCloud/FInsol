@extends('admin.layouts.admin')

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
    <div class="row g-3 mb-3">
        <div class="col-md-12 col-xxl-3">
            <div class="card h-md-100 ecommerce-card-min-width">
                <div class="card-body d-flex flex-column justify-content-end">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">GST Overview</h5>
                                            <p class="card-text">With supporting text below as a natural lead-in to
                                                additional content.</p>
                                            <a href="{{ URL('/admin/user/gst/details/' . $userId) }}"
                                                class="btn btn-primary">GST</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Copy of Returns</h5>
                                            <p class="card-text">With supporting text below as a natural lead-in to
                                                additional content.</p>
                                            <a href="{{ URL('/admin/user/gst/copyofreturns/' . $userId) }}"
                                                class="btn btn-primary">Copy of Returns</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title"> User Documents </h5>
                                            <p class="card-text">With supporting text below as a natural lead-in to
                                                additional content.</p>
                                            <a href="{{ URL('/admin/user/gst/uploaddocuments/' . $userId) }}"
                                                class="btn btn-primary"> Documents</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-sm-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Registrations</h5>
                                            <p class="card-text">With supporting text below as a natural lead-in to
                                                additional content.</p>
                                            <a href="{{ URL('/admin/user/forms/dashboard/details/' . $userId) }}"
                                                class="btn btn-primary">Registrations</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Companies Act</h5>
                                            <p class="card-text">With supporting text below as a natural lead-in to
                                                additional content.</p>
                                            <a href="{{ URL('/admin/user/companiesact/dashboard/details/' . $userId) }}"
                                                class="btn btn-primary">Companies Act</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Certification</h5>
                                            <p class="card-text">With supporting text below as a natural lead-in to
                                                additional content.</p>
                                            <a href="{{ URL('/admin/user/certification/dashboard/details/' . $userId) }}"
                                                class="btn btn-primary">Certification</a>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row mt-3">
                                <div class="col-sm-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Payments</h5>
                                            <p class="card-text">With supporting text below as a natural lead-in to
                                                additional content.</p>
                                            <a href="{{ URL('/admin/user/payments/' . $userId) }}"
                                                class="btn btn-primary">Payments</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Legal Work</h5>
                                            <p class="card-text">With supporting text below as a natural lead-in to
                                                additional content.</p>
                                            <a href="{{ URL('/admin/user/legal-work/dashboard/details/' . $userId) }}"
                                                class="btn btn-primary">Legal Work</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Loan & Finance</h5>
                                            <p class="card-text">With supporting text below as a natural lead-in to
                                                additional content.</p>
                                            <a href="{{ URL('/admin/user/loan-finance/dashboard/details/' . $userId) }}"
                                                class="btn btn-primary">Loan & Finance</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
