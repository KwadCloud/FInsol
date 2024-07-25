@extends('user.layouts.app')
@section('content')
    @php
        use App\Models\UserGstDetail;
    @endphp
    <div class="row g-3">
        <div class="col-xl-12">
            <div class="card mb-3">
                <div class="card-body text-center">
                    <div class="row">
                        <div class="card-body" bis_skin_checked="1">
                            <div class="table-responsive scrollbar">
                                <h5 class="mb-2">Payment Report</h5>
                                <table class="table table-condensed table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Id</th>
                                            <th scope="col">Payment Status</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Payment Id</th>
                                            <th scope="col">Payment Request Id</th>
                                            <th scope="col">Created at</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @php $t=1; @endphp
                                        @foreach ($payment_history as $detail)
                                            <tr class="align-middle">

                                                @php
                                                    $payment_status = $detail->staus;
                                                    if ($detail->staus == 'Credit') {
                                                        $payment_status = 'Success';
                                                    }
                                                @endphp
                                                <td class="text-nowrap">{{ $t }}
                                                </td>

                                                <td class="text-nowrap">
                                                    {{ $payment_status }}
                                                </td>
                                                <td class="text-nowrap">
                                                    {{ $detail->type }}
                                                </td>
                                                <td class="text-nowrap">
                                                    ₹{{ $detail->amount }}
                                                </td>
                                                <td class="text-nowrap">
                                                    {{ $detail->payment_id }}
                                                </td>
                                                <td class="text-nowrap">
                                                    {{ $detail->payment_request_id }}
                                                </td>
                                                <td class="text-nowrap">
                                                    {{ $detail->created_at }}
                                                </td>

                                            </tr>
                                            @php $t++; @endphp
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!------ GST options drop close ------->
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    .hiddenRow {
        padding: 0 !important;
    }

    .hiddenRow1 {
        padding: 0 !important;
    }

    .hiddenRow2 {
        padding: 0 !important;
    }
</style>