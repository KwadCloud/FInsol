@php
    use App\Models\UserGstDetail;
@endphp
<div id="tableExample" data-list='{"valueNames":["name","email","age"],"page":15,"pagination":true}'>
    <div class="table-responsive scrollbar">
        <div id="alert-dd"></div>

        <table class="table table-bordered table-striped fs--1 mb-0">
            <thead class="bg-200 text-900">
                <tr>
                    <th scope="col">GST Number</th>
                    <th scope="col">Trade Name</th>
                    <th scope="col">Form Type</th>
                    <th scope="col">Year</th>
                    <th scope="col">Month</th>
                    <th scope="col">Quarter</th>
                    <th scope="col">File Download</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>

            <tbody class="list">

                @if ($copyofreturns)
                    @foreach ($copyofreturns as $list)
                        @php
                            $gstDetail = UserGstDetail::find($list->user_gst_id);

                        @endphp
                        <tr class="align-middle" data-toggle="collapse" class="accordion-toggle">

                            <td class="text-nowrap">{{ $list->gst_number }}</td>
                            <td class="text-nowrap">{{ $list->trade_name }}</td>
                            <td class="text-nowrap">{{ $list->form_type }}</td>
                            <td class="text-nowrap">{{ $list->year ? $list->year : '-' }}</td>
                            <td class="text-nowrap">{{ $list->month ? $list->month : '-' }}</td>
                            <td class="text-nowrap">{{ $list->quarter ? $list->quarter : '--' }}</td>

                            <td>
                                <form action="{{ url('admin/user/gst/download/copyofreturns/file/' . $list->user_id) }}"
                                    method="POST">
                                    @csrf
                                    <input type="hidden" name="files" value="{{ $list->documents }}">
                                    <input type="hidden" name="form_type" value="{{ $list->form_type }}">
                                    <button class="btn btn-primary btn-xs mt-2 bsgstdwbtn"
                                        type="submit"><small>Download File</small>&nbsp;&nbsp;<span
                                            class="text-500 fas fa-download"></span></button>
                                </form>
                            </td>
                            @php
                                $id = $list->id . '-' . $list->user_id;
                            @endphp

                            <td><a href="{{ url('admin/user/gst/copyofreturns/delete/' . $id) }}"><button
                                        class="btn btn-sm">Delete</button></a></td>
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
                <a class="fw-semi-bold" href="#!" data-list-view="*" data-btn="show-more">View all<span class="fas fa-angle-right ms-1"
                        data-fa-transform="down-1"></span></a><a class="fw-semi-bold d-none" href="#!"
                    data-list-view="less">View
                    Less<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
            </p>
        </div>
        <div class="col-auto d-flex">
            <button class="btn btn-sm btn-primary" type="button" data-list-pagination="prev">
                <span>Previous</span>
            </button>
            <button class="btn btn-sm btn-primary px-4 ms-2" type="button" data-list-pagination="next">
                <span>Next</span>
            </button>
        </div>
    </div>
</div>
