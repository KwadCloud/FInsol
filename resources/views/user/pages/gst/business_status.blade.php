@extends('user.layouts.app')
@section('content')
    @php
        use App\Models\UserGstDetail;
    @endphp
    <div class="row g-3">
        <div class="col-md-12 col-xxl-3">
            <div class="card h-md-100 ecommerce-card-min-width">
                <!-- ============================================-->
                <!-- <section> begin ============================-->
                <section class="text-center">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <h1 style="color: #2a3468;" class="fs-2 fs-sm-4 fs-md-5">GST Registration <span
                                    style="color:#ec465f">Status
                                    </span>
                                </h1>
                                <p class="lead">Things you will get right out of the box with Finsol.</p>
                            </div>
                        </div>

                        <!------ GST options drop ------->

                        <div class="row mt-2 g-3">
                            <div class="card-body" bis_skin_checked="1">

                                <div class="table-responsive scrollbar">
                                    <div class="container">
                                        <div class="col-md-12">
                                            <div class="panel panel-default">
                                                <div class="panel-body">
                                                    @if (session('success'))
                                                        <div class="alert alert-success border-2 d-flex align-items-center"
                                                            role="alert">
                                                            <div class="bg-success me-3 icon-item"><span
                                                                    class="fas fa-check-circle text-white fs-3"></span>
                                                            </div>
                                                            <p class="mb-0 flex-1">{{ session('success') }}</p>
                                                            <button class="btn-close" type="button" data-bs-dismiss="alert"
                                                                aria-label="Close"></button>
                                                        </div>
                                                    @endif

                                                    @if (session('raisedfilenotexist'))
                                                        <div class="alert alert-danger border-2 d-flex align-items-center"
                                                            role="alert">
                                                            <div class="bg-danger me-3 icon-item"><span
                                                                    class="fas fa-check-circle text-white fs-3"></span>
                                                            </div>
                                                            <p class="mb-0 flex-1">
                                                                {{ session('raisedfilenotexist') }}</p>
                                                            <button class="btn-close" type="button" data-bs-dismiss="alert"
                                                                aria-label="Close"></button>
                                                        </div>
                                                    @endif

                                                    <table class="table table-condensed table-striped">
                                                        <thead>
                                                            <tr>

                                                                <th scope="col">Trade Name</th>
                                                                <th scope="col">GST Number</th>
                                                                <!-- <th scope="col">GST Type</th> -->
                                                                <th scope="col">Admin Note</th>
                                                                <th scope="col">Type</th>
                                                                <th scope="col">Status</th>

                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            @if ($userGstDetails)
                                                                @foreach ($userGstDetails as $detail)
                                                                    <tr class="align-middle" data-toggle="collapse"
                                                                        data-target="#{{ $detail->gst_type }}"
                                                                        class="accordion-toggle">
                                                                        <!-- <td><button class="btn btn-default btn-xs"><span
                                                                                                class="glyphicon glyphicon-eye-open"></span></button>
                                                                                    </td> -->
                                                                        <td class="text-nowrap">
                                                                            <div class="align-items-center">

                                                                                <div class="ms-2">
                                                                                    {{ $detail->trade_name }}
                                                                                </div>
                                                                            </div>
                                                                        </td>

                                                                        <td class="text-nowrap">
                                                                            {{ isset($detail->gst_number) ? $detail->gst_number : '-' }}
                                                                        </td>
                                                                        <!-- <td class="text-nowrap">{{ isset($detail->gst_type) ? $detail->gst_type : '-' }}</td> -->
                                                                        <td class="" style="font-size: 12px;">
                                                                            {{ isset($detail->admin_note) ? $detail->admin_note : '-' }}
                                                                            </< /td>
                                                                        <td class="text-nowrap">
                                                                            {{ isset($detail->type) ? $detail->type : '-' }}
                                                                        </td>

                                                                        <td >
                                                                            @if ($detail->status == 2)
                                                                                <span
                                                                                    class="badge badge rounded-pill d-block p-2 badge-subtle-warning">Query
                                                                                    Raised - Click here <span
                                                                                        class="ms-1 fas fa-stream"
                                                                                        data-fa-transform="shrink-2"></span>
                                                                                </span>
                                                                                @if ($detail->raised_img != '')
                                                                                    <form action="{{ route('raisedFile') }}"
                                                                                        method="POST">
                                                                                        @csrf

                                                                                        <input type="hidden" name="files"
                                                                                            value="{{ $detail->raised_img }}">

                                                                                        <button
                                                                                            class="btn btn-primary btn-xs mt-2 bsgstdwbtn"
                                                                                            type="submit"><small>Download
                                                                                                File</small>&nbsp;&nbsp;<span
                                                                                                class="text-500 fas fa-download"></span></button>
                                                                                    </form>
                                                                                @endif
                                                                            @else
                                                                                @if ($detail->status == 3)
                                                                                    <span
                                                                                        class="badge badge rounded-pill d-block p-2 badge-subtle-warning">Query
                                                                                        Updated<span
                                                                                            class="ms-1 fas fa-stream"
                                                                                            data-fa-transform="shrink-2"></span></span>
                                                                                @else
                                                                                    @if ($detail->status == 4)
                                                                                        <span
                                                                                            class="badge badge rounded-pill d-block p-2 badge-subtle-success">Approved<span
                                                                                                class="ms-1 fas fa-check"
                                                                                                data-fa-transform="shrink-2"></span></span>

                                                                                        @if ($detail->approved_img != '')
                                                                                            <form
                                                                                                action="{{ route('approvedFile') }}"
                                                                                                method="POST">
                                                                                                @csrf

                                                                                                <input type="hidden"
                                                                                                    name="files"
                                                                                                    value="{{ $detail->approved_img }}">

                                                                                                <button
                                                                                                    class="btn btn-primary btn-xs mt-2 bsgstdwbtn"
                                                                                                    type="submit"><small>Download
                                                                                                        File</small>&nbsp;&nbsp;<span
                                                                                                        class="text-500 fas fa-download"></span></button>
                                                                                            </form>
                                                                                        @endif
                                                                                    @else
                                                                                        <span
                                                                                            class="badge badge rounded-pill d-block p-2 badge-subtle-primary">Processing
                                                                                            <span class="ms-1 fas fa-redo"
                                                                                                data-fa-transform="shrink-2">
                                                                                            </span>
                                                                                        </span>
                                                                                    @endif
                                                                                @endif
                                                                            @endif
                                                                        </td>

                                                                    </tr>
                                                                    @if ($detail->status == 2)
                                                                        <tr>
                                                                            <td colspan="6" class="hiddenRow">
                                                                                <div id="{{ $detail->gst_type }}"
                                                                                    class="accordian-body collapse">
                                                                                    <!-- {{ $detail->gst_type }} -->
                                                                                    <br /><br />
                                                                                    <div class="col">
                                                                                        <form class="needs-validation"
                                                                                            novalidate="novalidate"
                                                                                            action="{{ route('gst.query_raised') }}"
                                                                                            method="post"
                                                                                            enctype="multipart/form-data">
                                                                                            @csrf
                                                                                            <span
                                                                                                class="badge badge rounded-pill d-block p-2 badge-subtle-warning">Query
                                                                                                Raised
                                                                                            </span>
                                                                                            <br />
                                                                                            <div class="mb-3">
                                                                                                <label class="form-label"
                                                                                                    for="note">
                                                                                                    {{ $detail->admin_note }}
                                                                                                </label>
                                                                                            </div>

                                                                                            <label>Enter Your
                                                                                                Suggestion:</label>
                                                                                            <textarea name="user_note" style="height:90px;width:100%"></textarea>

                                                                                            <input type="hidden"
                                                                                                name="gstid"
                                                                                                value="{{ $detail->id }}" />
                                                                                            <div class="mt-3">
                                                                                                <label>Upload
                                                                                                    Required
                                                                                                    doc:</label>
                                                                                                <input type="file"
                                                                                                    name="additional_img[]"
                                                                                                    id="image-upload"
                                                                                                    class="myfrm form-control"
                                                                                                    multiple />
                                                                                            </div>

                                                                                            <div class="mt-3">
                                                                                                <button
                                                                                                    class="btn btn-primary me-1 mb-1"
                                                                                                    type="submit">Save</button>

                                                                                                <button
                                                                                                    class="btn btn-primary me-1 mb-1"
                                                                                                    type="reset">Cancel</button>
                                                                                            </div>
                                                                                        </form>
                                                                                    </div>
                                                                                    <br />
                                                                                </div>
                                                                            </td>

                                                                        </tr>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        </tbody>
                                                    </table>

                                                    <br>
                                                    <br>
                                                    <br>

                                                </div>

                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!------ GST options drop close ------->
                    </div>
                </section>
            </div><!-- end of .container-->

        </div>
    </div>

    <div class="mt-3 row g-3">
        <div class="col-md-12 col-xxl-3">
            <div class="card h-md-100 ecommerce-card-min-width">
                <!-- ============================================-->
                <!-- <section> begin ============================-->
                <section class="text-center">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <h1 style="color: #2a3468;" class="fs-2 fs-sm-4 fs-md-5">Upload Documents
                                    <span style="color:#ec465f">Status
                                    </span>
                                </h1>
                                <p class="lead">Things you will get right out of the box with Finsol.</p>
                            </div>
                        </div>

                        <!------ GST options drop ------->

                        <div class="row mt-2 g-3">

                            <div class="table-responsive scrollbar">
                                <div class="container">
                                    <div class="col-md-12">
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                                @if (session('success'))
                                                    <div class="alert alert-success border-2 d-flex align-items-center"
                                                        role="alert">
                                                        <div class="bg-success me-3 icon-item"><span
                                                                class="fas fa-check-circle text-white fs-3"></span>
                                                        </div>
                                                        <p class="mb-0 flex-1">{{ session('success') }}</p>
                                                        <button class="btn-close" type="button" data-bs-dismiss="alert"
                                                            aria-label="Close"></button>
                                                    </div>
                                                @endif

                                                @if (session('filenotexist'))
                                                    <div class="alert alert-danger border-2 d-flex align-items-center"
                                                        role="alert">
                                                        <div class="bg-danger me-3 icon-item"><span
                                                                class="fas fa-check-circle text-white fs-3"></span>
                                                        </div>
                                                        <p class="mb-0 flex-1">{{ session('filenotexist') }}
                                                        </p>
                                                        <button class="btn-close" type="button" data-bs-dismiss="alert"
                                                            aria-label="Close"></button>
                                                    </div>
                                                @endif
                                                <table class="table table-condensed table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">GST Number</th>
                                                            <th scope="col">Trade Name</th>
                                                            <th scope="col">Document Type</th>
                                                            <th scope="col">Year</th>
                                                            <th scope="col">Month</th>
                                                            <th scope="col">Quarter</th>
                                                            <th scope="col">Status</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        @if ($userUploadeDocuments)
                                                            @foreach ($userUploadeDocuments as $doc)
                                                                @php
                                                                    $gstDetail = UserGstDetail::find($doc->gst_id);

                                                                @endphp
                                                                <tr class="align-justify">
                                                                    <!-- <td><button class="btn btn-default btn-xs"><span
                                                                                                class="glyphicon glyphicon-eye-open"></span></button>
                                                                                    </td> -->
                                                                    <td class="text-nowrap">
                                                                        {{ isset($gstDetail->gst_number) ? $gstDetail->gst_number : '-' }}
                                                                    </td>
                                                                    <td class="text-nowrap">
                                                                        {{ isset($gstDetail->trade_name) ? $gstDetail->trade_name : '-' }}
                                                                    </td>
                                                                    <td class="text-nowrap">
                                                                        {{ $doc->doc_type }} </td>

                                                                    <td class="text-nowrap">
                                                                        {{ $doc->year ? $doc->year : '-' }}</< /td>

                                                                    <td class="text-nowrap">
                                                                        {{ $doc->month ? date('F', mktime(0, 0, 0, $doc->month, 1)) : '-' }}
                                                                        </< /td>

                                                                    <td class="text-nowrap">
                                                                        {{ $doc->quarter ? $doc->quarter : '-' }}
                                                                        </< /td>

                                                                        <!-- <td >
                                                                                    <form action="{{ route('uploadDocumentFile') }}" method="POST">
                                                                                                    @csrf
                                                                                                    
                                                                                                      <input type="hidden" name="files" value="{{ $doc->documents }}">
                                                                                                      <input type="hidden" name="doc_type" value="{{ $doc->doc_type }}">
                                                                                                      <button class="btn btn-primary btn-xs mt-2 bsgstdwbtn" type="submit"><small>Download File</small>&nbsp;&nbsp;<span  class="text-500 fas fa-download"></span></button>
                                                                                                </form>
                                                                                    </td> -->

                                                                    <td class="text-nowrap">
                                                                        @if ($doc->status == 1)
                                                                            <span
                                                                                class="badge badge rounded-pill d-block p-2 badge-subtle-primary">Processing
                                                                                <span class="ms-1 fas fa-redo"
                                                                                    data-fa-transform="shrink-2">
                                                                                </span>
                                                                            </span>
                                                                        @else
                                                                            <span
                                                                                class="badge badge rounded-pill d-block p-2 badge-subtle-success">Approved<span
                                                                                    class="ms-1 fas fa-check"
                                                                                    data-fa-transform="shrink-2">
                                                                                </span>
                                                                            </span>
                                                                        @endif

                                                                    </td>

                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                    </tbody>

                                                </table>
                                                <!-- {{ $userUploadeDocuments->links() }}                                                                                         -->
                                                <div class="text-right">
                                                    @if ($userUploadeDocuments->onFirstPage())
                                                        <span class="btn btn-sm disabled">First</span>
                                                    @else
                                                        <a href="{{ $userUploadeDocuments->url(1) }}"
                                                            class="btn  btn-sm">First</a>
                                                    @endif

                                                    @if ($userUploadeDocuments->onFirstPage())
                                                        <span class="btn  btn-sm disabled">Previous</span>
                                                    @else
                                                        <a href="{{ $userUploadeDocuments->previousPageUrl() }}"
                                                            class="btn  btn-sm">Previous</a>
                                                    @endif

                                                    @if ($userUploadeDocuments->hasMorePages())
                                                        <a href="{{ $userUploadeDocuments->nextPageUrl() }}"
                                                            class="btn  btn-sm">Next</a>
                                                    @else
                                                        <span class="btn  btn-sm disabled">Next</span>
                                                    @endif

                                                    @if ($userUploadeDocuments->hasMorePages())
                                                        <a href="{{ $userUploadeDocuments->url($userUploadeDocuments->lastPage()) }}"
                                                            class="btn  btn-sm">Last</a>
                                                    @else
                                                        <span class="btn  btn-sm disabled">Last</span>
                                                    @endif
                                                    <div>

                                                    </div>

                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <!------ GST options drop close ------->
                            </div>
                        </div><!-- end of .container-->
                </section><!-- <section> close ============================-->
                <!-- ============================================-->

            </div>
        </div>
    @endsection

    <style>
        .hiddenRow {
            padding: 0 !important;
        }
    </style>
    <script>
        window.onload = function() {
            var errorMessage = document.querySelector('.alert-danger');
            errorMessage.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        };
    </script>
