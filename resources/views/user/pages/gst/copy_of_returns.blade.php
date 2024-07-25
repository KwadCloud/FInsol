@extends('user.layouts.app')
@section('content')
    <div class="row g-3">
        <div class="col-md-12 col-xxl-3">
            <div class="card h-md-100 ecommerce-card-min-width">
                <!-- ============================================-->
                <!-- <section> begin ============================-->
                <section class="text-center">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <h1 style="color: #2a3468;" class="fs-2 fs-sm-4 fs-md-5">
                                    <span style="color:#ec465f">Copy Of Returns</span>
                                </h1>
                                <p class="lead">Things you will get right out of the box with Finsol.</p>
                            </div>
                        </div>

                        <!------ GST options drop ------->
                        <form action="{{ route('gst.copy_of_returns.filter') }}" method="POST">
                            @csrf
                            <div class="mt-1 row g-2">
                                <div class="col-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="form-wizard-progress-wizard-legalnamename">Select
                                            GST Number</label>
                                        <select name="gstnumber" class="form-select" id="gstSelect" required="required"
                                            onChange="getFormType()" aria-label="Default select example">
                                            <option value="">GST Number</option>
                                            @foreach ($gstNumbers as $key => $numbers)
                                                <option value="{{ $numbers->gst_number }}"
                                                    @if ($selectedgstNumber == $numbers->gst_number) selected @endif>
                                                    {{ $numbers->gst_number }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">Please provide GST Number
                                        </div>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="form-wizard-progress-wizard-legalnamename">Form
                                            Type</label>
                                        <select class="form-control" id="formtype" name="formtype" onChange="getYear()">
                                            <option value="0">Select Form</option>
                                            @foreach ($formtypes as $form)
                                                <option value="{{ $form->type }}"
                                                    @if ($selectedformtype == $form->type) selected @endif>
                                                    {{ $form->type }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">Please provide Year
                                        </div>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="form-wizard-progress-wizard-legalnamename">Select
                                            Year</label>
                                        <select class="form-select" required="required" id="gstyear" name="year"
                                            aria-label="Default select example" onchange="getMonth()">
                                            @php
                                                $currentYear = date('Y');
                                                $startYear = $currentYear - 10;
                                                $endYear = $currentYear;
                                            @endphp
                                            <option value="">Select Year</option>
                                            @for ($year = $endYear; $year >= $startYear; $year--)
                                                <option value="{{ $year }}"
                                                    @if ($selectedyear == $year) selected @endif>
                                                    {{ $year }}</option>
                                            @endfor
                                        </select>
                                        <div class="invalid-feedback">Please provide Year
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-1 row g-2">

                                <div class="col-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="form-wizard-progress-wizard-legalnamename">Select
                                            Month</label>

                                        <select class="form-select" id="gstmonth" name="month" onchange="getQuarter()">
                                            <option value="">Select Month</option>
                                            @for ($month = 1; $month <= 12; $month++)
                                                <option value="{{ $month }}"
                                                    @if ($selectedmonth == $month) selected @endif>
                                                    {{ date('F', mktime(0, 0, 0, $month, 1)) }}</option>
                                            @endfor
                                        </select>
                                        <div class="invalid-feedback">Please provide Month Or Quarter
                                        </div>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="form-wizard-progress-wizard-legalnamename">Select
                                            Quarter</label>
                                        <select class="form-select" id="gstquarter" name="quarter">
                                            <option value="">Select Quarter</option>
                                            <option value="{{ 'January-March' }}">{{ 'January-March' }}
                                            </option>
                                            <option value="{{ 'April-June' }}">{{ 'April-June' }}</option>
                                            <option value="{{ 'July-September' }}">{{ 'July-September' }}
                                            </option>
                                            <option value="{{ 'October-December' }}">{{ 'October-December' }}
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="mb-3">
                                        <label class="form-label">Find</label>
                                        <input class="form-control btn btn-primary" type="submit" name="submit"
                                            value="Search" />
                                    </div>
                                </div>

                            </div>

                        </form>

                        <div class="table-responsive scrollbar">
                            <br><br>

                            <table class="table table-hover table-striped overflow-hidden">
                                <thead>
                                    <tr>
                                        <th scope="col">Trade Name</th>
                                        <th scope="col">GST Number</th>
                                        <th scope="col">Year</th>
                                        <th scope="col">Month</th>
                                        <th scope="col">Quarter</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Download</th>

                                    </tr>
                                </thead>
                                @if ($items)
                                    <tbody>
                                        @if (count($items) > 0)
                                            @foreach ($items as $item)
                                                <tr class="align-middle">

                                                    <td class="text-nowrap">
                                                        <div class="align-items-center">
                                                            <div class="ms-2">{{ $item->trade_name }}</div>
                                                        </div>
                                                    </td>
                                                    <td class="text-nowrap">{{ $item->gst_number }}</td>
                                                    <td class="text-nowrap">{{ $item->year }}</td>
                                                    <td class="text-nowrap">{{ $item->month }}</td>
                                                    <td class="text-nowrap">{{ $item->quarter }}</td>
                                                    @php
                                                        if (
                                                            $item->form_type == 'GSTR1' ||
                                                            $item->form_type == 'GSTR2A'
                                                        ) {
                                                            $css = 'badge-subtle-success';
                                                        } elseif (
                                                            $item->form_type == 'GSTR2B' ||
                                                            $item->form_type == 'GSTR2X'
                                                        ) {
                                                            $css = 'badge-subtle-warning';
                                                        } elseif (
                                                            $item->form_type == 'GSTR9' ||
                                                            $item->form_type == 'GSTR9C'
                                                        ) {
                                                            $css = 'badge-subtle-info';
                                                        }

                                                    @endphp

                                                    <td><span
                                                            class="badge {{ $css }}">{{ $item->form_type }}</span>
                                                    </td>
                                                    <td class="text-nowrap">

                                                        <form action="{{ route('copyofreturnsFile') }}" method="POST">
                                                            @csrf

                                                            <input type="hidden" name="files"
                                                                value="{{ $item->documents }}">

                                                            <button class="btn btn-link p-0" type="submit"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="download"><span
                                                                    class="text-500 fas fa-download"></span>
                                                            </button>
                                                        </form>

                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr class="align-middle">
                                                <td colspan="7"><b>No records found....</b></td>
                                            </tr>
                                        @endif
                                    </tbody>
                                @endif

                            </table>

                            <br><br>
                        </div>

                        <!------ GST options drop close ------->
                    </div>
            </div><!-- end of .container-->
            </section><!-- <section> close ============================-->
            <!-- ============================================-->

        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    var urlpath = "{{ url('/') }}";

    function getFormType() {

        var gstValue = $('#gstSelect').val();
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $('#formtype').find('option').not(':first').remove();
        if (gstValue) {
            $.ajax({
                url: urlpath + '/getformtype',
                type: 'POST',
                data: {
                    gst: gstValue
                },
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(response) {

                    var len = response.length;
                    for (var i = 0; i < len; i++) {
                        var type = response[i]['form_type'];


                        $("#formtype").append("<option value='" + type + "' >" + type + "</option>");

                    }
                    // Handle the response from the server


                },
                error: function(xhr, status, error) {
                    // Handle any errors that occur during the AJAX request
                    console.error(error);
                }
            });
        }
    }

    function getYear() {

        var gstValue = $('#gstSelect').val();
        var formType = $('#formtype').val();
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $('#gstyear').find('option').not(':first').remove();
        if (gstValue) {
            $.ajax({
                url: urlpath + '/getyear',
                type: 'POST',
                data: {
                    gst: gstValue,
                    formtype: formType
                },
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(response) {

                    var len = response.length;
                    for (var i = 0; i < len; i++) {
                        var year = response[i]['year'];
                        $("#gstyear").append("<option value='" + year + "' >" + year + "</option>");

                    }
                    // Handle the response from the server


                },
                error: function(xhr, status, error) {
                    // Handle any errors that occur during the AJAX request
                    console.error(error);
                }
            });
        }





    }




    function getMonth() {

        var gstValue = $('#gstSelect').val();
        var formType = $('#formtype').val();
        var gstyear = $('#gstyear').val();
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $('#gstmonth').find('option').not(':first').remove();
        if (gstValue) {
            $.ajax({
                url: urlpath + '/getmonth',
                type: 'POST',
                data: {
                    gst: gstValue,
                    formtype: formType,
                    gstyear: gstyear
                },
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(response) {

                    var len = response.length;
                    for (var i = 0; i < len; i++) {
                        var month = response[i]['month'];
                        $("#gstmonth").append("<option value='" + month + "' >" + month + "</option>");

                    }
                    // Handle the response from the server


                },
                error: function(xhr, status, error) {
                    // Handle any errors that occur during the AJAX request
                    console.error(error);
                }
            });
        }
    }


    function getQuarter() {
        var gstValue = $('#gstSelect').val();
        var formType = $('#formtype').val();
        var gstyear = $('#gstyear').val();
        var gstmonth = $('#gstmonth').val();
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $('#gstquarter').find('option').not(':first').remove();
        if (gstValue) {
            $.ajax({
                url: urlpath + '/getquarter',
                type: 'POST',
                data: {
                    gst: gstValue,
                    formtype: formType,
                    gstyear: gstyear,
                    gstmonth: gstmonth
                },
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(response) {

                    var len = response.length;
                    for (var i = 0; i < len; i++) {
                        var quarter = response[i]['quarter'];
                        $("#gstquarter").append("<option value='" + quarter + "' >" + quarter +
                            "</option>");

                    }
                    // Handle the response from the server


                },
                error: function(xhr, status, error) {
                    // Handle any errors that occur during the AJAX request
                    console.error(error);
                }
            });
        }

    }
</script>
