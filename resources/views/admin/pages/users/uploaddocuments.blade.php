@extends('admin.layouts.admin')

{{-- @push('custom_styles') --}}
{{-- @endpush --}}
@php
    use App\Models\UserGstDetail;
@endphp

@section('content')

    <div class="row g-3 mb-3">

        <div class="col-md-12 col-xxl-3">

            <div class="card h-md-100 ecommerce-card-min-width">
                <div class="card-header pb-0">
                    <h6 class="mb-0 mt-2 d-flex align-items-center">List of User Upload Documents</h6>
                </div>
                <div class="card-body d-flex flex-column justify-content-end">
                    <div class="row">
                        <div class="col-12">
                            <div id="tableExample"
                                data-list='{"valueNames":["name","email","age"],"page":15,"pagination":true}'>
                                <div class="table-responsive scrollbar">
                                    <div id="alert-dd"></div>

                                    <table class="table table-bordered table-striped fs--1 mb-0">
                                        <thead class="bg-200 text-900">
                                            <tr>
                                                <!-- <th scope="col"></th> -->
                                                <th scope="col">GST Number</th>
                                                <th scope="col">Document Type</th>
                                                <th scope="col">Year</th>
                                                <th scope="col">Month</th>
                                                <th scope="col">Quarter</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">File Download</th>
                                            </tr>
                                        </thead>

                                        <tbody class="list">

                                            @if ($userUploadeDocuments)
                                                @foreach ($userUploadeDocuments as $doc)
                                                    @php
                                                        $gstDetail = UserGstDetail::find($doc->gst_id);

                                                    @endphp
                                                    <tr class="align-middle" data-toggle="collapse"
                                                        data-target="#{{ $gstDetail->gst_type }}" class="accordion-toggle">
                                                        <!-- <td><button class="btn btn-default btn-xs"><span
                                                                                                class="glyphicon glyphicon-eye-open"></span></button>
                                                                                    </td> -->
                                                        <td class="text-nowrap">
                                                            {{ $gstDetail->gst_number ? $gstDetail->gst_number : 'NA' }}
                                                        </td>
                                                        <td class="text-nowrap"> {{ $doc->doc_type }} </td>

                                                        <td class="text-nowrap">{{ $doc->year ? $doc->year : 'NA' }}
                                                            </< /td>

                                                        <td class="text-nowrap">
                                                            {{ $doc->month ? date('F', mktime(0, 0, 0, $doc->month, 1)) : 'NA' }}
                                                            </< /td>

                                                        <td class="text-nowrap">
                                                            {{ $doc->quarter ? $doc->quarter : 'NA' }}</< /td>
                                                        <td class="text-nowrap">
                                                            @if ($doc->status == 1)
                                                                <div>
                                                                    <span
                                                                        class="badge badge rounded-pill d-block p-2 badge-subtle-primary">Processing
                                                                        <span class="ms-1 fas fa-redo"
                                                                            data-fa-transform="shrink-2">
                                                                        </span>

                                                                    </span>
                                                                    <br />
                                                                    <span
                                                                        class="badge badge rounded-pill d-block p-2 badge-subtle-secondary"
                                                                        onClick="changeApprove({{ $doc->id }})">Make
                                                                        it Approve
                                                                        <span class="ms-1 fa fa-cog"
                                                                            data-fa-transform="shrink-2">
                                                                        </span>
                                                                    </span>

                                                                </div>
                                                            @else
                                                                <span
                                                                    class="badge badge rounded-pill d-block p-2 badge-subtle-success">Approved<span
                                                                        class="ms-1 fas fa-check"
                                                                        data-fa-transform="shrink-2">
                                                                    </span>
                                                                </span>
                                                            @endif
                                                        </td>

                                                        <td colspan=7>
                                                            <form
                                                                action="{{ url('admin/user/gst/download/uploaddocument/file/' . $doc->user_id) }}"
                                                                method="POST">
                                                                @csrf

                                                                <input type="hidden" name="files"
                                                                    value="{{ $doc->documents }}">
                                                                <input type="hidden" name="doc_type"
                                                                    value="{{ $doc->doc_type }}">
                                                                <button class="btn btn-primary btn-xs mt-2 bsgstdwbtn"
                                                                    type="submit"><small>Download
                                                                        File</small>&nbsp;&nbsp;<span
                                                                        class="text-500 fas fa-download"></span></button>
                                                            </form>
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
<script src="https://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>

<script>
    var adminUrl = "{{ url('admin') }}";

    function changeApprove(itemId) {

        $.ajax({
            url: adminUrl + '/user/gst/change_approve/' + itemId,
            type: 'GET',
            success: function(data) {
                if (data == 1) {
                    var html =
                        '<div class="alert alert-success" id="alert-dd">Approved the Document Successfuly!</div>'
                    $('#alert-dd').html(html);
                    setTimeout(function() {
                        $(".alert-success").fadeOut("slow", function() {
                            $(this).remove();
                            location.reload();
                        });
                    }, 2000);
                }
            },
            error: function(xhr) {
                // Handle error cases
                console.log(xhr.responseText);
            }
        });
    }
</script>
