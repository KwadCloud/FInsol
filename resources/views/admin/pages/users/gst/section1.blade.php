@php
    use App\Models\User;
@endphp

<div class="col-lg-8 pe-lg-2">
    <div class="card mb-3">
        <div class="card-header">
            <h5 class="mb-0">GST Details: {{ $user->name }}</h5>
        </div>
        <div class="card-body bg-light">
            <div class="row">
                <div class="col-lg-6 mb-3"> <label class="form-label" for="gst-type">GST Type :
                    </label>{{ $gstDetails->gst_type }}</div>
                <div class="col-lg-6 mb-3"> <label class="form-label" for="gst-number">GST Number :
                    </label>{{ $gstDetails->gst_number }}</div>
                <div class="col-lg-6 mb-3"> <label class="form-label" for="mobile">Mobile :
                    </label>{{ $gstDetails->mobile_linked_aadhar }}</div>
                <div class="col-lg-6 mb-3"> <label class="form-label" for="email1">Email :
                    </label>{{ $gstDetails->email_id }}</div>
            </div>
        </div>
    </div>
    <div class="card mb-3">

        @if (session('filenotexistsection1'))
            <div class="alert alert-danger border-2 d-flex align-items-center" role="alert">
                <div class="bg-danger me-3 icon-item"><span class="fas fa-check-circle text-white fs-3"></span>
                </div>
                <p class="mb-0 flex-1">{{ session('filenotexistsection1') }}</p>
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card-header">
            <h5 class="mb-0">Basic Individual Documents</h5>
        </div>
        <div class="card-body bg-light">

            <?php
            //Columns must be a factor of 12 (1,2,3,4,6,12)
            $numOfCols = 3;
            $rowCount = 0;
            $bootstrapColWidth = 12 / $numOfCols;
            ?>
            <div class="row">
                @foreach ($gstIndividualDocuments as $row)
                    <div class="col-md-{{ $bootstrapColWidth }}">
                        <h6>{{ $row->doc_name }}</h6>
                        <div class="thumbnail">
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
                        </div>
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
</div>
