@if ($gstDetails->gst_type == 'Company')
    <div class="card mb-3">
        <div class="card-header">
            <h5 class="mb-0">Basic Company Documents: {{ $user->name }}</h5>
        </div>
        <div class="card-body bg-light">

            <?php
            //Columns must be a factor of 12 (1,2,3,4,6,12)
            $numOfCols = 3;
            $rowCount = 0;
            $bootstrapColWidth = 12 / $numOfCols;
            ?>
            <div class="row">

                @foreach ($gstCompanyDocuments as $row)
                    <div class="col-md-<?php echo $bootstrapColWidth; ?>">
                        <h6>{{ $row->doc_name }}</h6>
                        @php
                            $keyname = $row->doc_key_name;
                        @endphp

                        <form action="{{ url('admin/user/gst/files/' . $gstDetails->user_id) }}" method="POST">
                            @csrf

                            <input type="hidden" name="files" value="{{ $gstDetails[$keyname] }}">
                            <input type="hidden" name="gst_type" value="{{ $gstDetails->gst_type }}">
                            <input type="hidden" name="gst_id" value="{{ $gstDetails->id }}">

                            <button class="btn btn-primary btn-xs mt-2 bsgstdwbtn" type="submit"><small>Download
                                    File</small>&nbsp;&nbsp;<span class="text-500 fas fa-download"></span></button>
                        </form>
                        <br />
                    </div>
                    @php
                        $rowCount++;
                        if ($rowCount % $numOfCols == 0) {
                            echo '</div><div class="row">';
                        }
                    @endphp
                @endforeach
            </div>

        </div>
    </div>

    @if ($gstCompanyDirectorsDocuments)
        @foreach ($gstCompanyDirectors as $index => $director)
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="mb-0">Company {{ $index + 1 }} Details / Documents</h5>
                    <h6><span>Director Email :{{ $director->director_email }}</span>&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;<span>Director Mobile :{{ $director->director_mobile }}</span></h6>
                </div>
                <div class="card-body bg-light">

                    <?php
                    //Columns must be a factor of 12 (1,2,3,4,6,12)
                    $numOfCols1 = 3;
                    $rowCount1 = 0;
                    $bootstrapColWidth1 = 12 / $numOfCols1;
                    ?>
                    <div class="row">

                        @foreach ($gstCompanyDirectorsDocuments as $row)
                            <div class="col-md-<?php echo $bootstrapColWidth1; ?>">
                                <h6>{{ $row->doc_name }}</h6>
                                @php
                                    $keyname = $row->doc_key_name;
                                @endphp

                                <form action="{{ url('admin/user/gst/files/' . $gstDetails->user_id) }}"
                                    method="POST">
                                    @csrf

                                    <input type="hidden" name="files" value="{{ $director[$keyname] }}">
                                    <input type="hidden" name="gst_type" value="{{ $gstDetails->gst_type }}">
                                    <input type="hidden" name="gst_id" value="{{ $gstDetails->id }}">

                                    <button class="btn btn-primary btn-xs mt-2 bsgstdwbtn"
                                        type="submit"><small>Download
                                            File</small>&nbsp;&nbsp;<span
                                            class="text-500 fas fa-download"></span></button>
                                </form>
                                <br />
                            </div>
                            @php
                                $rowCount1++;
                                if ($rowCount1 % $numOfCols1 == 0) {
                                    echo '</div><div class="row">';
                                }
                            @endphp
                        @endforeach
                    </div>

                </div>

            </div>
        @endforeach
    @endif
@endif
