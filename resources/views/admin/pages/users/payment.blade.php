@extends('admin.layouts.admin')

@section('content')

    <div class="row g-3 mb-3">

        <div class="col-md-12 col-xxl-3">
            <div class="card h-md-100 ecommerce-card-min-width">
                <div class="card-header pb-0">
                    <h6 class="mb-0 mt-2 d-flex align-items-center">All User Payments</h6>
                    <h6 class="float-right">Total: <?php $total = 0;
                    foreach ($transaction as $detail) {
                        if ($detail->status === 'Credit') {
                            $total = $total + (int) $detail->amount;
                        }
                    }
                    echo '₹' . $total; ?></h6>
                </div>
                <div class="card-body d-flex flex-column justify-content-end">
                    @if ($transaction)
                        <div class="row">
                            <div class="col-12">
                                <div id="tableExample"
                                    data-list='{"valueNames":["type","updated_at","staus", "amount"],"page":15,"pagination":true}'>
                                    <div class="table-responsive scrollbar">

                                        <table class="table table-bordered table-striped fs--1 mb-0">
                                            <thead class="bg-200 text-900">
                                                <tr>
                                                    <!-- <th scope="col"></th> -->
                                                    <th scope="col">User(ID)</th>
                                                    <th scope="col">Type</th>
                                                    <th scope="col">Amount</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Payment ID</th>
                                                    <th scope="col">Date</th>
                                                </tr>
                                            </thead>

                                            <tbody class="list">
                                                @if ($transaction)
                                                    @foreach ($transaction as $detail)
                                                        <tr class="align-middle">
                                                            <td>{{ $user->name }}({{ $user->id ? $user->id : '' }})
                                                            </td>
                                                            <td class="text-nowrap">
                                                                {{ $detail->type ? $detail->type : '--' }}</td>

                                                            <td class="text-nowrap">
                                                                ₹{{ $detail->amount ? $detail->amount : '' }}</td>
                                                            <td>{{ $detail->staus ? $detail->staus : '' }}</td>
                                                            <td>{{ $detail->payment_id ? $detail->payment_id : '' }}
                                                            </td>
                                                            <td>{{ $detail->updated_at ? $detail->updated_at : '' }}
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
                                                <span class="d-none d-sm-inline-block"
                                                    data-list-info="data-list-info"></span>
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
        </div>
    </div>

@endsection
