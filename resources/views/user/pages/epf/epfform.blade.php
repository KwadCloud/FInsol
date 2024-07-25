@extends('user.layouts.app')
@section('content')
    <div class="tab-content">
        <div class="tab-pane preview-tab-pane active" role="tabpanel" aria-labelledby="tab-dom-switch" id="dom-switch">
            <ul class="nav nav-pills" id="pill-switch" role="tablist">
                <li class="nav-item"><a class="nav-link active" id="epf-new-home" data-bs-toggle="tab" href="#epf-new"
                        role="tab" aria-controls="epf-new" aria-selected="true">New</a>
                </li>
                <li class="nav-item"><a class="nav-link" id="epf-existing-home" data-bs-toggle="tab" href="#epf-existing"
                        role="tab" aria-controls="epf-existing" aria-selected="false">Existing</a></li>

            </ul>
            <div class="tab-content mt-3" id="pill-switchContent">
                <!------------------tab 1----------------->
                @include('user.pages.epf.new')
                <!------------Tab 2 ------------>
                @include('user.pages.epf.existing')

            </div>
        </div>
    </div>

    <!--- add Partner JS  -->
@endsection
<script>
    setTimeout(function() {
        $('.alert-success').fadeOut('fast');
    }, 2000);
</script>
