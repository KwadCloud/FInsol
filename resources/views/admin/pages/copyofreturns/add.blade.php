<form class="needs-validation" novalidate="novalidate" action="{{ url('admin/user/gst/copyofreturns/create/' . $userId) }}"
    method="post"enctype="multipart/form-data">
    @csrf
    <div class="detailsmargin card-header d-flex flex-between-center bg-light py-2">
        <h6 class="detailspadding mb-0">Select Business</h6>
    </div>
    <div class="mt-1 row g-2">
        <div class="col-6">
            <div class="mb-3">
                <label class="form-label" for="form-wizard-progress-wizard-legalnamename">Select
                    GST Number</label>
                <select name="gstnumber" class="form-select" id="gstSelect1" required="required"
                    onChange="getTradeNameData()" aria-label="Gst number">
                    <option value="">GST Number</option>
                    @foreach ($gstNumbers as $key => $numbers)
                        <option value="{{ $numbers->gst_number }}">{{ $numbers->gst_number }}</option>
                    @endforeach
                </select>
                <input type="hidden" name="gstid" value="" class="gstid" />
                <input type="hidden" name="trade_name" value="" class="tradeName" />
                <div class="invalid-feedback">Please select GST Number</div>
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label class="form-label" for="form-wizard-progress-wizard-legalnamename">Trade
                    Name of
                    the
                    Business</label><input required="" class="form-control tradeName" type="text" disabled
                    name="trade_name" placeholder="Legal Name of Business" value=""
                    id="form-wizard-progress-wizard-legalname tradeName" data-wizard-validate-legal-name="true" />
                <div class="invalid-feedback">Please provide Trade Name</div>
            </div>
        </div>

        <div class="detailsmargin card-header d-flex flex-between-center bg-light py-2">
            <h6 class="detailspadding mb-0">Select Form Type and Year</h6>
        </div>
    </div>
    <div class="mt-1 row g-2">
        <div class="col-6">
            <div class="mb-3">

                <label class="form-label" for="form-wizard-progress-wizard-legalnamename">Select
                    Form Type</label>
                <select name="formtype" class="form-select" id="formtype" required="required"
                    aria-label="Default select example">
                    <option value="">Form Type</option>
                    @foreach ($formTypes as $key => $type)
                        <option value="{{ $type->type }}">{{ $type->type }}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback">Please select Form Type</div>
            </div>
        </div>

        <div class="col-6">
            <div class="mb-3">

                <label class="form-label" for="form-wizard-progress-wizard-legalnamename">Select
                    Year</label>
                <select class="form-select" required="required" name="year" aria-label="Default select example">
                    @php
                        $currentYear = date('Y');
                        $startYear = $currentYear - 20;
                        $endYear = $currentYear;
                    @endphp
                    <option value="">Select Year</option>
                    @for ($year = $endYear; $year >= $startYear; $year--)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endfor
                </select>
                <div class="invalid-feedback">Please select Year</div>
                <!-- <label class="form-label" for="form-wizard-progress-wizard-legalnamename">Select
                                          Month</label>
                                        
                                        <select class="form-select" required="required" name="month">
                                        <option value="">Select Month</option>
                                            @for ($month = 1; $month <= 12; $month++)
<option value="{{ $month }}">{{ date('F', mktime(0, 0, 0, $month, 1)) }}</option>
@endfor
                                        </select> -->
                <!-- <div class="invalid-feedback">Please select Month</div> -->
            </div>
        </div>

        <div class="col-6">
            <div class="mb-3">
                <label class="form-label mb-3" for="form-wizard-progress-wizard-legalnamename ">
                </label>
                <input type="radio" name="doc_type" checked="checked" value="Monthly" /> Monthly
                &nbsp; &nbsp; &nbsp; <input type="radio" name="doc_type" value="Quarter" /> Quarter
            </div>
        </div>

        <div class="col-6" id="inputBoxMonthly">
            <div class="mb-3">
                <label class="form-label" for="form-wizard-progress-wizard-legalnamename">Select
                    Month</label>
                <select class="form-select" name="month">
                    <option value="">Select Month</option>
                    @for ($month = 1; $month <= 12; $month++)
                        <option value="{{ date('F', mktime(0, 0, 0, $month, 1)) }}">
                            {{ date('F', mktime(0, 0, 0, $month, 1)) }}</option>
                    @endfor
                </select>
                <div class="invalid-feedback">Please select Month</div>

            </div>
        </div>

        <div class="col-6" id="inputBoxQuarter">
            <div class="mb-3">

                <label class="form-label" for="form-wizard-progress-wizard-legalnamename">Select
                    Quarter</label>

                <select class="form-select" name="quarter">
                    <option value="">Select Quarter</option>

                    <option value="{{ 'January-March' }}">{{ 'January-March' }}</option>
                    <option value="{{ 'April-June' }}">{{ 'April-June' }}</option>
                    <option value="{{ 'July-September' }}">{{ 'July-September' }}</option>
                    <option value="{{ 'October-December' }}">{{ 'October-December' }}</option>
                </select>

                <div class="invalid-feedback">Please select Quarter</div>

            </div>
        </div>

        <div class="detailsmargin card-header d-flex flex-between-center bg-light py-2">
            <h6 class="detailspadding mb-0">Upload documents to copy of returns</h6>
        </div>
        <div class="col-12">
            <div class="bg-light">
                <input type="file" name="documents[]" required="required" class="form-control" multiple />
                <!-- <div class="tab-content">
                                          <div class="tab-pane preview-tab-pane active" role="tabpanel"
                                            aria-labelledby="tab-dom-77cd7e82-0ae3-4189-b6e8-f4e60ff78ac7"
                                            id="dom-77cd7e82-0ae3-4189-b6e8-f4e60ff78ac7">
                                            <div class="dropzone dropzone-multiple p-0" id="my-awesome-dropzone"
                                              data-dropzone="data-dropzone" action="#!">
                                              <div class="fallback"><input name="file" type="file"
                                                  multiple="multiple" /></div>
                                              <div class="dz-message" data-dz-message="data-dz-message"> <img
                                                  class="me-2" src="assets/img/icons/cloud-upload.svg" width="25"
                                                  alt="" />CLick or Drop your
                                                files here
                                              </div>
                                              <div class="dz-preview dz-preview-multiple m-0 d-flex flex-column">
                                                <div class="d-flex media mb-3 pb-3 border-bottom btn-reveal-trigger">
                                                  <img class="dz-image" src="assets/img/generic/image-file-2.png"
                                                    alt="..." data-dz-thumbnail="data-dz-thumbnail" />
                                                  <div class="flex-1 d-flex flex-between-center">
                                                    <div>
                                                      <h6 data-dz-name="data-dz-name"></h6>
                                                      <div class="d-flex align-items-center">
                                                        <p class="mb-0 fs--1 text-400 lh-1" data-dz-size="data-dz-size">
                                                        </p>
                                                        <div class="dz-progress"><span class="dz-upload"
                                                            data-dz-uploadprogress=""></span></div>
                                                      </div>
                                                      <span class="fs--2 text-danger"
                                                        data-dz-errormessage="data-dz-errormessage"></span>
                                                    </div>
                                                    <div class="dropdown font-sans-serif">
                                                      <button
                                                        class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal dropdown-caret-none"
                                                        type="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false"><span
                                                          class="fas fa-ellipsis-h"></span></button>
                                                      <div class="dropdown-menu dropdown-menu-end border py-2"><a
                                                          class="dropdown-item" href="#!"
                                                          data-dz-remove="data-dz-remove">Remove
                                                          File</a>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>   -->
            </div>
        </div>
        <div class="col-4"></div>
        <div class="col-4">
            <div class="mb-3">
                <button class="mt-4 btn btn-primary me-1 mb-1" type="submit">Upload Copy of Returns</button>
            </div>
        </div>
        <div class="col-4"></div>
    </div>

</form>

<script>
    $(document).ready(function() {
        $('#inputBoxQuarter').hide();
        $('#inputBoxMonthly').show();
        $('input[name="doc_type"]').change(function() {
            var selectedOption = $('input[name="doc_type"]:checked').val();
            if (selectedOption === "Monthly") {
                $('#inputBoxMonthly').show();
                $('#inputBoxQuarter').hide();
                $('#inputBoxQuarter').find('input[name="quarter"]').removeAttr('required');
            } else {
                $('#inputBoxQuarter').show();
                $('#inputBoxMonthly').hide();
                $('#inputBoxMonthly').find('input[name="month"]').removeAttr('required');
            }
        });
    });

    var adminUrl = "{{ url('admin') }}";

    function getTradeNameData() {

        var gstValue = $('#gstSelect1').val();

        $('.tradeName').val('')
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        if (gstValue) {
            $.ajax({
                url: urlpath + '/user/gst/gettradename',
                type: 'POST',
                data: {
                    gst: gstValue
                },
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(response) {
                    // Handle the response from the server
                    $('.tradeName').val(response.trade_name);
                    $('.gstid').val(response.id);
                    // console.log(response);
                },
                error: function(xhr, status, error) {
                    // Handle any errors that occur during the AJAX request
                    console.error(error);
                }
            });
        }
    }

    $(document).ready(function() {
        setTimeout(function() {
            $(".alert-success").fadeOut("slow", function() {
                $(this).remove();
            });
            $(".alert-danger").fadeOut("slow", function() {
                $(this).remove();
            });
        }, 3000);
    });
</script>
