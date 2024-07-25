@php

    //Columns must be a factor of 12 (1,2,3,4,6,12)
    $numOfCols = 3;
    $rowCount = 0;
    $bootstrapColWidth = 12 / $numOfCols;
@endphp
<div class="row">
    @foreach ($documents as $row)
        <div class="col-md-{{ $bootstrapColWidth }}">
            <h6>{{ $row->doc_name }}</h6>
            <div class="thumbnail">
                @php
                    $keyname = $row->doc_key_name;
                @endphp
                @if ($details[$keyname])
                    <form action="{{ url('admin/user/files/' . $details->user_id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="files" value="{{ $details[$keyname] }}">
                        <input type="hidden" name="id" value="{{ $details->id }}">
                        <input type="hidden" name="form_type" value="{{ $form_type }}">

                        <button class="btn btn-primary btn-xs mt-2 bsgstdwbtn" type="submit">
                            <small>Download File</small>&nbsp;&nbsp;<span class="text-500 fas fa-download"></span>
                        </button>
                    </form>
                @else
                    <div>No Files Uploaded</div>
                @endif
                <!-- <a class=" justify-content-between ms-auto" href="#!">
         Download
        </a> -->

            </div>
            <br />
        </div>
        <?php
        $rowCount++;
        if ($rowCount % $numOfCols == 0) {
            echo '</div><div class="row">';
        } ?>
    @endforeach