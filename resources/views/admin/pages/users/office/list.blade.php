@extends('admin.layouts.admin')

@section('content')

    <div class="row g-3 mb-3">

        <div class="col-md-12 col-xxl-3">

            <div class="card h-md-100 ecommerce-card-min-width">
                <div class="card-header pb-0 d-flex align-items-center">
                    <h4 class="mb-0 mt-2 d-flex align-items-center">List of Offices</h4>
                    <button id="btnExport" type="button" class="btn btn-success btn-sm ms-auto">
                        <i class="fa fa-file-csv"></i> Export to CSV
                    </button>
                </div>
                <div class="card-body d-flex flex-column justify-content-end">
                    <div class="row">
                        <div class="col-12">
                            @if (session()->has('message'))
                                <p class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('message') }}
                                </p>
                            @endif
                            <div id="tableExample"
                                data-list='{"valueNames":["name","email","type_of_user","access_level_id"],"page":15,"pagination":true,"filter":{"key":"type_of_user"}}'>
                                <div class="row justify-content-start g-2">
                                    <div class="col-md-auto col-sm-12 mb-3">
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
                                    <div class="col-md-auto col-sm-12 px-md-3">
                                        <select class="form-select form-select-sm mb-3" aria-label="Bulk actions"
                                            data-list-filter="data-list-filter">
                                            <option selected="" value="">Select Office</option>
                                            <option value="Head Office">Head Office</option>
                                            <option value="State Office">State Office</option>
                                            <option value="District Office">District Office</option>
                                            <option value="Block Office">Block Office</option>
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
                                                <th class="sort" data-sort="name">Name</th>
                                                <th class="sort" data-sort="email">Email</th>
                                                <th class="sort" data-sort="type_of_user">Office</th>
                                                <th class="sort" data-sort="access_level_id">Access ID</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list">
                                            @foreach ($users as $keyname => $user)
                                                <tr>
                                                    <td class="name">{{ $user['name'] }}</td>
                                                    <td class="email">{{ $user['email'] }}</td>
                                                    <td class="type_of_user">
                                                        {{ $user['type_of_user'] }}
                                                    </td>

                                                    <td class="access_level_id">
                                                        {{ $user['access_level_id'] }}
                                                    </td>
                                                    <td>
                                                        @if ($user->name != 'Admin')
                                                            <a class="btn btn-sm btn-primary"
                                                                href="{{ url('admin/edit-employee/' . $user['id']) }}">Edit</a>
                                                            <a class="btn btn-sm btn-danger"
                                                                href="{{ url('admin/delete-employee/' . $user['id']) }}">Delete</a>
                                                        @endif
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
                                    <div class="col-auto d-flex"><button class="btn btn-sm btn-primary" type="button"
                                            data-list-pagination="prev"><span>Previous</span></button><button
                                            class="btn btn-sm btn-primary px-4 ms-2" type="button"
                                            data-list-pagination="next"><span>Next</span></button></div>
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
