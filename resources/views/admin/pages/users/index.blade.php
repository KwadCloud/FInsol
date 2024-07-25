@extends('admin.layouts.admin')
@section('content')

    <div class="row g-3 mb-3">
        <div class="col-md-12 col-xxl-3">
            <div class="card h-md-100 ecommerce-card-min-width">
                <div class="card-header pb-0">
                    <h6 class="mb-0 mt-2 d-flex align-items-center">List of Users</h6>
                </div>
                <div class="card-body d-flex flex-column justify-content-end">
                    <div class="row">
                        <div class="col-12">
                            @if (session()->has('message'))
                                <p class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('message') }}
                                </p>
                            @endif
                            @if (Auth::user()->type_of_user === 'Head Office')
                                <div class="d-flex align-items-center">
                                    <h6 class="mb-1">Filter</h6>
                                    <a href="{{ url()->current() }}" class="btn btn-primary btn-sm ms-auto">Reset Filter
                                    </a>
                                    <button id="btnExport" type="button" class="btn btn-success btn-sm ms-2">
                                        <i class="fa fa-file-csv"></i> Export to CSV
                                    </button>
                                </div>
                                <form action="" class="row">
                                    <div class="col-md-3 col-12">
                                        <select class="form-select form-select-sm mb-3" id="filter-select-state"
                                            name="state">
                                            @if (request()->has('state') && request('state') != null)
                                                @foreach ($states as $state)
                                                    <option value="{{ $state->id }}"
                                                        @if ((int) request('state') === $state->id) selected @endif>
                                                        {{ $state->name }}
                                                    </option>
                                                @endforeach
                                            @else
                                                <option selected="" value="">Select State</option>
                                                @foreach ($states as $state)
                                                    <option value="{{ $state->id }}">{{ $state->name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    <div class="col-md-3 col-12 px-3">
                                        <select class="form-select form-select-sm mb-3" id="filter-select-district"
                                            name="district">
                                            @if (request()->has('state') && request('state') != null)
                                                @if (request()->has('district') && request('district') == null)
                                                    <option selected="" value="">Select Block</option>
                                                @endif
                                                @foreach ($districts as $district)
                                                    <option value="{{ $district->d_code }}"
                                                        @if (request()->has('district') && (int) request('district') === $district->d_code) selected @endif>
                                                        {{ $district->name }}
                                                    </option>
                                                @endforeach
                                            @else
                                                <option selected="" value="">Select District</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <select class="form-select form-select-sm mb-3" id="filter-select-block"
                                            name="block">
                                            @if (request()->has('district') && request('district') != null)
                                                @if (request()->has('block') && request('block') == null)
                                                    <option selected="" value="">Select Block</option>
                                                @endif
                                                @foreach ($blocks as $block)
                                                    <option value="{{ $block->id }}"
                                                        @if (request()->has('block') && (int) request('block') === $block->id) selected @endif>
                                                        {{ $block->name }}
                                                    </option>
                                                @endforeach
                                            @else
                                                <option selected="" value="">Select Block</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <button class="btn btn-primary btn-sm" type="submit">
                                            <i class="fas fa-filter"></i>
                                        </button>
                                    </div>
                                </form>
                            @endif
                            <div id="tableExample"
                                data-list='{"valueNames":["id","name","mobile","aadhaar","email","status"],"page":15,"pagination":true,"filter":{"key":"status"}}'>
                                <div class="row justify-content-start g-2">
                                    <div class="col-md-auto col-sm-12 mb-3 mt-4">
                                        <form>
                                            <div class="input-group">
                                                <input class="form-control form-control-sm shadow-none search"
                                                    type="search" placeholder="Search..." aria-label="search" />
                                                <div class="input-group-text bg-transparent">
                                                    <span class="fa fa-search fs--1 text-600"></span>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-md-auto col-sm-12 px-md-3 mt-md-4">
                                        <select class="form-select form-select-sm mb-3" aria-label="Bulk actions"
                                            data-list-filter="data-list-filter">
                                            <option selected="" value="">Select user status</option>
                                            <option value="active">Active</option>
                                            <option value="not_active">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="table-responsive scrollbar">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <table class="table table-bordered table-striped fs--1 mb-0">
                                        <thead class="bg-200 text-900">
                                            <tr>
                                                <th class="sort" data-sort="id">ID</th>
                                                <th class="sort" data-sort="name">Name</th>
                                                <th class="sort" data-sort="mobile">Mobile</th>
                                                <th class="sort" data-sort="aadhaar">Aadhaar</th>
                                                <th class="sort" data-sort="email">Email</th>
                                                <th class="sort" data-sort="status">Status</th>
                                                <th>Details</th>

                                            </tr>
                                        </thead>
                                        <tbody class="list">
                                            @foreach ($users as $keyname => $user)
                                                <tr>
                                                    <td>{{ $user->id }}</td>
                                                    <td class="name">{{ $user['name'] }}</td>
                                                    <td class="mobile">{{ $user['mobile'] }}</td>
                                                    <td class="aadhaar">{{ $user['aadhaar'] }}</td>
                                                    <td class="email">{{ $user['email'] }}</td>
                                                    <td class="status">{{ $user['status'] }}</td>
                                                    <td>
                                                        <a href="{{ URL('/admin/user/profile/' . $user['id']) }}">View
                                                            Profile</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row align-items-center mt-3">
                                    <div class="pagination d-none"></div>
                                    <div class="col">
                                        <p class="mb-0 fs--1">
                                            <span class="d-none d-sm-inline-block" data-list-info="data-list-info"></span>
                                            <span class="d-none d-sm-inline-block"> &mdash;</span>
                                            <a class="fw-semi-bold" href="#!" data-list-view="*"
                                                data-btn="show-more">View all<span class="fas fa-angle-right ms-1"
                                                    data-fa-transform="down-1"></span></a><a class="fw-semi-bold d-none"
                                                href="#!" data-list-view="less">View
                                                Less<span class="fas fa-angle-right ms-1"
                                                    data-fa-transform="down-1"></span></a>
                                        </p>
                                    </div>
                                    <div class="col-auto d-flex">
                                        <button class="btn btn-sm btn-primary" type="button"
                                            data-list-pagination="prev">
                                            <span>Previous</span>
                                        </button>
                                        <button class="btn btn-sm btn-primary px-4 ms-2" type="button"
                                            data-list-pagination="next">
                                            <span>Next</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto ps-0">
                            <div class="echart-bar-weekly-sales h-100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
