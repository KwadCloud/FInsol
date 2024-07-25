@extends('admin.layouts.admin')

@section('content')
    @if ($auth->type_of_user === 'Head Office')
        <div class="card mb-3">
            <div class="bg-holder d-none d-lg-block bg-card"
                style="background-image:url(../../assets/img/icons/spot-illustrations/corner-4.png);"></div>
            <!--/.bg-holder-->
            <div class="card-body position-relative">
                <div class="row">
                    <div class="col-lg-8">
                        <h3 class="mb-4">Payment History</h3>
                        <h5 class="mb-2">Total: ₹{{ $total }}</h5>
                        <h5>Commission</h5>
                        <p class="mt-1">
                            <b>State:</b> ₹{{ $total / 10 }}<br>
                            <b>District:</b> ₹{{ $total / 10 }}<br>
                            <b>Block:</b> ₹{{ $total / 5 }}<br>
                            <b>Marketing:</b> ₹{{ $total / 4 }}<br>
                            <b>Admin:</b> ₹{{ $total / 4 }}<br>
                            <b>Remaining:</b> ₹{{ ($total * 3) / 20 }}<br>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="card mb-3">
        <div class="card-header pb-0">
            <h5 class="mb-3 mt-2 d-flex align-items-center">All Payments</h5>
        </div>
        <div class="card-body d-flex flex-column justify-content-end">
            @if ($transaction)
                <div class="row">
                    @if ($auth->type_of_user === 'Head Office')
                        <form action="">
                            <div class="col-12">
                                <div class="d-flex align-items-center">
                                    <h6 class="mb-1">Filter</h6>
                                    <a href="{{ url()->current() }}" class="btn btn-primary btn-sm ms-auto">Reset Filter</a>
                                    <button id="btnExport" type="button" class="btn btn-success btn-sm ms-2">
                                        <i class="fa fa-file-csv"></i> Export to CSV
                                    </button>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-12 mb-sm-2">
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
                                </div>
                            </div>
                            <div class="col-12">
                                <h6 class="mb-1">Between Date</h6>
                                <div class="row">
                                    <div class="col-md-3 col-12 mb-2">
                                        <input class="form-control form-control-sm" type="date" name="from"
                                            id="from" placeholder="From date..."
                                           @if (request('from')) value="<?= date_format(date_create(request('from')), 'Y-m-d') ?>" @endif>
                                    </div>
                                    <div class="col-md-3 col-12 mb-2">
                                        <input class="form-control form-control-sm" type="date" name="to"
                                            id="to" placeholder="To date..."
                                            @if (request('to')) value="<?= date_format(date_create(request('to')), 'Y-m-d') ?>" @endif>
                                    </div>
                                    <div class="col-md-3 col-12 mb-2">
                                        <button class="btn btn-primary btn-sm" type="submit">
                                            <i class="fas fa-filter"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @endif
                    <div class="col-12">
                        <div id="tableExample"
                            data-list='{"valueNames":["user_id", "name", "type", "amount", "staus", "payment_id", "updated_at"],"page":15,"pagination":true,"filter":{"key":"staus"}}'>
                            <div class="row justify-content-start g-2">
                                <div class="col-md-auto col-sm-12 mb-md-3 mt-md-4">
                                    <form>
                                        <div class="input-group">
                                            <input class="form-control form-control-sm shadow-none search" type="search"
                                                placeholder="Search..." aria-label="search" />
                                            <div class="input-group-text bg-transparent">
                                                <span class="fa fa-search fs--1 text-600"></span>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-auto col-sm-12 px-md-3 mt-md-4">
                                    <select class="form-select form-select-sm mb-3" aria-label="Bulk actions"
                                        data-list-filter="data-list-filter">
                                        <option selected="" value="">Select payment status</option>
                                        <option value="Credit">Credit</option>
                                        <option value="Failed">Failed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="table-responsive scrollbar">
                                <table class="table table-bordered table-striped fs--1 mb-0">
                                    <thead class="bg-200 text-900">
                                        <tr>
                                            <!-- <th scope="col"></th> -->
                                            <th scope="col" class="sort" data-sort="user_id">ID</th>
                                            <th scope="col" class="sort" data-sort="name">User</th>
                                            <th scope="col" class="sort" data-sort="type">Type</th>
                                            <th scope="col" class="sort" data-sort="amount">Amount</th>
                                            <th scope="col" class="sort" data-sort="staus">Status</th>
                                            <th scope="col" class="sort" data-sort="payment_id">Payment
                                                ID</th>
                                            <th scope="col" class="sort" data-sort="updated_at">Date
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody class="list">
                                        @if ($transaction)
                                            @foreach ($transaction as $detail)
                                                @php
                                                    $user = App\Models\User::select('*')
                                                        ->where('id', $detail->user_id)
                                                        ->first();
                                                @endphp
                                                <tr class="align-middle">
                                                    <td class="user_id">
                                                        {{ $detail->user_id ? $detail->user_id : '' }}
                                                    </td>
                                                    <td class="name">
                                                        {{ $user->name }}
                                                    </td>
                                                    <td class="text-nowrap type">
                                                        {{ $detail->type ? $detail->type : '--' }}</td>

                                                    <td class="text-nowrap amount">
                                                        ₹{{ $detail->amount ? $detail->amount : '' }}</td>
                                                    <td class="staus">
                                                        @if ($detail->staus == 'Credit')
                                                            <span class="badge badge rounded-pill badge-subtle-success">
                                                                {{ $detail->staus }}
                                                            </span>
                                                        @else
                                                            <span class="badge badge rounded-pill badge-subtle-danger">
                                                                {{ $detail->staus }}
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td class="payment_id">
                                                        {{ $detail->payment_id ? $detail->payment_id : '' }}
                                                    </td>
                                                    <td class="updated_at">
                                                        {{ $detail->updated_at ? $detail->updated_at : '' }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
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
                                            data-btn="show-more">View
                                            all<span class="fas fa-angle-right ms-1"
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
            @endif
        </div>
    </div>
@endsection
