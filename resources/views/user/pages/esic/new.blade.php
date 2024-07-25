<div class="tab-pane fade show active" id="esic-new" role="tabpanel" aria-labelledby="new-tab">
    <div class="d-flex mb-4">
        <span class="fa-stack me-2 ms-n1"><i class="fas fa-circle fa-stack-2x text-300"></i><i
                class="fa-inverse fa-stack-1x text-primary fas fa-check-double"></i></span>
        <div class="col">
            <h5 class="mb-0 text-primary position-relative"><span class="bg-200 dark__bg-1100 pe-3">New ESIC
                    Registration</span><span
                    class="border position-absolute top-50 translate-middle-y w-100 start-0 z-n1"></span>
            </h5>
            <p class="mb-0">Get your ESIC registration done quicly with Finsol.</p>
        </div>
    </div>
    <div class="row g-0">
        <div class="col-xl-12">
            <div class="card mb-3">
                <div class="card-header">
                    <h6 class="mb-0">Select the Registration type</h6>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success border-2 d-flex align-items-center" role="alert">
                            <div class="bg-success me-3 icon-item"><span
                                    class="fas fa-check-circle text-white fs-3"></span>
                            </div>
                            <p class="mb-0 flex-1">{{ session('success') }}</p>
                            <button class="btn-close" type="button" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="tab-content">
                        <div class="tab-pane preview-tab-pane active" role="tabpanel"
                            aria-labelledby="tab-dom-61c83f7c-d9df-458a-94bd-f4e645b55d13"
                            id="dom-61c83f7c-d9df-458a-94bd-f4e645b55d13">
                            <ul class="nav nav-pills" id="pill-myTab" role="tablist">
                                <li class="nav-item"><a class="nav-link active" id="esic-company-home"
                                        data-bs-toggle="tab" href="#esic-company" role="tab"
                                        aria-controls="esic-company" aria-selected="true">Company</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" id="esic-company-other" data-bs-toggle="tab"
                                        href="#esic-others" role="tab" aria-controls="esic-others"
                                        aria-selected="false">Others</a></li>

                            </ul>
                            <div class="tab-content mt-3" id="pill-myTabContent">
                                <!------------------tab 1----------------->
                                @include('user.pages.esic.company')
                                <!------------Tab 2 ------------>
                                @include('user.pages.esic.others')

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
