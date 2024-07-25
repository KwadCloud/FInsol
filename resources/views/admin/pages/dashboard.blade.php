<?php
$all_employees = App\Models\Admin::count();
?>
@extends('admin.layouts.admin')

@section('content')
    <div class="row g-3 mb-3">
        <div class="col-md-3 col-xxl-3">
            <div class="card h-md-100 ecommerce-card-min-width">
                <div class="bg-holder bg-card"
                    style="background-image:url({{ url('assets/img/icons/spot-illustrations/corner-2.png') }});"></div>
                <div class="card-header pb-0">
                    <h6 class="mb-0 mt-2 d-flex align-items-center">
                        All Users
                    </h6>
                </div>
                <div class="card-body d-flex flex-column justify-content-end">
                    <div class="row">
                        <div class="col">
                            <p class="font-sans-serif lh-1 mb-1 fs-4">{{ $count }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if ($user->type_of_user == 'Head Office')
            <div class="col-md-3 col-xxl-3">
                <div class="card h-md-100">
                    <div class="bg-holder bg-card"
                        style="background-image:url({{ url('assets/img/icons/spot-illustrations/corner-3.png') }});"></div>
                    <div class="card-header pb-0">
                        <h6 class="mb-0 mt-2 d-flex align-items-center">
                            Offices
                        </h6>
                    </div>
                    <div class="card-body d-flex flex-column justify-content-end">
                        <div class="row justify-content-between">
                            <div class="col-auto align-self-end">
                                <div class="fs-4 fw-normal font-sans-serif text-700 lh-1 mb-1">{{ $all_employees }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="col-md-3 col-xxl-3">
            <div class="card h-md-100">
                <div class="bg-holder bg-card"
                    style="background-image:url({{ url('assets/img/icons/spot-illustrations/corner-1.png') }});"></div>
                <div class="card-header pb-0">
                    <h6 class="mb-0 mt-2 d-flex align-items-center">
                        Total Payments
                    </h6>
                </div>
                <div class="card-body d-flex flex-column justify-content-end">
                    <div class="row justify-content-between">
                        <div class="col-auto align-self-end">
                            <div class="fs-4 fw-normal font-sans-serif text-700 lh-1 mb-1">₹{{ $total }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--<div class="row g-0">
        <div class="col-lg-6 pe-lg-2 mb-3">
            <div class="card h-lg-100 overflow-hidden">
                <div class="card-header bg-light">
                    <div class="row align-items-center g-2">
                        <div class="col-md-2">
                            <h6 class="mb-0">Form Count</h6>
                        </div>
                        <div class="col-md-10">
                            <form action="">
                                <div class="row g-1">
                                    <div class="col-md-4">
                                        <select class="form-select form-select-sm">
                                            <option>Working Time</option>
                                            <option>Estimated Time</option>
                                            <option>Billable Time</option>
                                        </select>
                                    </div>
                                    @if (Auth::user()->type_of_user === 'Head Office')
                                        <div class="col-md-4">
                                            <select class="form-select form-select-sm">
                                                <option>Working Time</option>
                                                <option>Estimated Time</option>
                                                <option>Billable Time</option>
                                            </select>
                                        </div>
                                    @elseif (Auth::user()->type_of_user === 'Head Office' || Auth::user()->type_of_user === 'State Office')
                                        <div class="col-md-4">
                                            <select class="form-select form-select-sm">
                                                <option>Working Time</option>
                                                <option>Estimated Time</option>
                                                <option>Billable Time</option>
                                            </select>
                                        </div>
                                    @elseif (Auth::user()->type_of_user === 'Head Office' ||
                                            Auth::user()->type_of_user === 'State Office' ||
                                            Auth::user()->type_of_user === 'District Office')
                                        <div class="col-md-4">
                                            <select class="form-select form-select-sm">
                                                <option>Working Time</option>
                                                <option>Estimated Time</option>
                                                <option>Billable Time</option>
                                            </select>
                                        </div>
                                    @endif
                                    <div class="col-md-4">
                                        <button class="btn btn-sm btn-primary" type="submit">Filter</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="row g-0 align-items-center py-2 position-relative border-bottom border-200">
                        <div class="col ps-x1 py-1 position-static">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-xl me-3">
                                    <div class="avatar-name rounded-circle bg-primary-subtle text-dark"><span
                                            class="fs-0 text-primary">F</span></div>
                                </div>
                                <div class="flex-1">
                                    <h6 class="mb-0 d-flex align-items-center"><a class="text-800 stretched-link"
                                            href="#!">Falcon</a><span
                                            class="badge rounded-pill ms-2 bg-200 text-primary">38%</span></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col py-1">
                            <div class="row flex-end-center g-0">
                                <div class="col-auto pe-2">
                                    <div class="fs--1 fw-semi-bold">12:50:00</div>
                                </div>
                                <div class="col-5 pe-x1 ps-2">
                                    <div class="progress bg-200 me-2" style="height: 5px;" role="progressbar"
                                        aria-valuenow="38" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar rounded-pill" style="width: 38%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-0 align-items-center py-2 position-relative border-bottom border-200">
                        <div class="col ps-x1 py-1 position-static">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-xl me-3">
                                    <div class="avatar-name rounded-circle bg-success-subtle text-dark"><span
                                            class="fs-0 text-success">R</span></div>
                                </div>
                                <div class="flex-1">
                                    <h6 class="mb-0 d-flex align-items-center"><a class="text-800 stretched-link"
                                            href="#!">Reign</a><span
                                            class="badge rounded-pill ms-2 bg-200 text-primary">79%</span></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col py-1">
                            <div class="row flex-end-center g-0">
                                <div class="col-auto pe-2">
                                    <div class="fs--1 fw-semi-bold">25:20:00</div>
                                </div>
                                <div class="col-5 pe-x1 ps-2">
                                    <div class="progress bg-200 me-2" style="height: 5px;" role="progressbar"
                                        aria-valuenow="79" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar rounded-pill" style="width: 79%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-0 align-items-center py-2 position-relative border-bottom border-200">
                        <div class="col ps-x1 py-1 position-static">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-xl me-3">
                                    <div class="avatar-name rounded-circle bg-info-subtle text-dark"><span
                                            class="fs-0 text-info">B</span></div>
                                </div>
                                <div class="flex-1">
                                    <h6 class="mb-0 d-flex align-items-center"><a class="text-800 stretched-link"
                                            href="#!">Boots4</a><span
                                            class="badge rounded-pill ms-2 bg-200 text-primary">90%</span></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col py-1">
                            <div class="row flex-end-center g-0">
                                <div class="col-auto pe-2">
                                    <div class="fs--1 fw-semi-bold">58:20:00</div>
                                </div>
                                <div class="col-5 pe-x1 ps-2">
                                    <div class="progress bg-200 me-2" style="height: 5px;" role="progressbar"
                                        aria-valuenow="90" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar rounded-pill" style="width: 90%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-0 align-items-center py-2 position-relative border-bottom border-200">
                        <div class="col ps-x1 py-1 position-static">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-xl me-3">
                                    <div class="avatar-name rounded-circle bg-warning-subtle text-dark"><span
                                            class="fs-0 text-warning">R</span></div>
                                </div>
                                <div class="flex-1">
                                    <h6 class="mb-0 d-flex align-items-center"><a class="text-800 stretched-link"
                                            href="#!">Raven</a><span
                                            class="badge rounded-pill ms-2 bg-200 text-primary">40%</span></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col py-1">
                            <div class="row flex-end-center g-0">
                                <div class="col-auto pe-2">
                                    <div class="fs--1 fw-semi-bold">21:20:00</div>
                                </div>
                                <div class="col-5 pe-x1 ps-2">
                                    <div class="progress bg-200 me-2" style="height: 5px;" role="progressbar"
                                        aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar rounded-pill" style="width: 40%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-0 align-items-center py-2 position-relative">
                        <div class="col ps-x1 py-1 position-static">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-xl me-3">
                                    <div class="avatar-name rounded-circle bg-danger-subtle text-dark"><span
                                            class="fs-0 text-danger">S</span></div>
                                </div>
                                <div class="flex-1">
                                    <h6 class="mb-0 d-flex align-items-center"><a class="text-800 stretched-link"
                                            href="#!">Slick</a><span
                                            class="badge rounded-pill ms-2 bg-200 text-primary">70%</span></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col py-1">
                            <div class="row flex-end-center g-0">
                                <div class="col-auto pe-2">
                                    <div class="fs--1 fw-semi-bold">31:20:00</div>
                                </div>
                                <div class="col-5 pe-x1 ps-2">
                                    <div class="progress bg-200 me-2" style="height: 5px;" role="progressbar"
                                        aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar rounded-pill" style="width: 70%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-light p-0"><a class="btn btn-sm btn-link d-block w-100 py-2"
                        href="#!">Show
                        all projects<svg class="svg-inline--fa fa-chevron-right fa-w-10 ms-1 fs--2" aria-hidden="true"
                            focusable="false" data-prefix="fas" data-icon="chevron-right" role="img"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg="">
                            <path fill="currentColor"
                                d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z">
                            </path>
                        </svg></a>
                </div>
            </div>
        </div>
    </div>-->
@endsection
