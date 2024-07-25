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
                <div class="card-header">
                    <h4 class="mb-0">Change Password</h4>
                </div>
                <div class="card-body bg-light">
                    <form class="row g-3" action="{{ url('password-update') }}" method="POST">
                        @csrf
                        @if ($errors->any())
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        @if (session()->has('message'))
                            <p class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </p>
                        @endif
                        <div class="col-lg-6">
                            <label class="form-label" for="current_password">Current Password</label>
                            <input class="form-control" id="current_password" type="password" name="current_password" />
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label" for="new_password">New Password</label>
                            <input class="form-control" id="new_password" type="password" name="new_password" />
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label" for="new_password_confirmation">Retype New Password</label>
                            <input class="form-control" id="new_password_confirmation" type="password"
                                name="new_password_confirmation" />
                        </div>
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <div class="col-12 d-flex justify-content-end">
                            <button class="btn btn-primary" type="submit">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--- add Partner JS  -->
@endsection
