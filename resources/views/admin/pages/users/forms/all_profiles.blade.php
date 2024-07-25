@extends('admin.layouts.admin')
@section('content')
    <div class="row g-3 mb-3">
        <div class="col-md-12 col-xxl-3">
            <div class="card h-md-100 ecommerce-card-min-width">

                <div class="card-body d-flex flex-column justify-content-end">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">

                                <!------------------section 1----------------->
                                <div class="col-lg-12 pe-lg-2">
                                    @if (session('filenotexist'))
                                        <div class="alert alert-danger border-2 d-flex align-items-center" role="alert">
                                            <div class="bg-danger me-3 icon-item"><span
                                                    class="fas fa-check-circle text-white fs-3"></span>
                                            </div>
                                            <p class="mb-0 flex-1">{{ session('filenotexist') }}</p>
                                            <button class="btn-close" type="button" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif

                                    @if ($profilePage == 'pan')
                                        @include('admin.pages.users.forms.profile.pan_profile')
                                    @elseif($profilePage == 'tan')
                                        @include('admin.pages.users.forms.profile.tan_profile')
                                    @elseif($profilePage == 'epf')
                                        @include('admin.pages.users.forms.profile.epf_profile')
                                    @elseif($profilePage == 'esic')
                                        @include('admin.pages.users.forms.profile.esic_profile')
                                    @elseif($profilePage == 'trademark')
                                        @include('admin.pages.users.forms.profile.trademark_profile')
                                    @elseif($profilePage == 'company')
                                        @include('admin.pages.users.forms.profile.company_profile')
                                    @elseif($profilePage == 'partnership')
                                        @include('admin.pages.users.forms.profile.partnership_profile')
                                    @elseif($profilePage == 'huf')
                                        @include('admin.pages.users.forms.profile.huf_profile')
                                    @elseif($profilePage == 'trust')
                                        @include('admin.pages.users.forms.profile.trust_profile')
                                    @elseif($profilePage == 'udamy')
                                        @include('admin.pages.users.forms.profile.udamy_profile')
                                    @elseif($profilePage == 'importexport')
                                        @include('admin.pages.users.forms.profile.importexport_profile')
                                    @elseif($profilePage == 'labour')
                                        @include('admin.pages.users.forms.profile.labour_profile')
                                    @elseif($profilePage == 'shop')
                                        @include('admin.pages.users.forms.profile.shop_profile')
                                    @elseif($profilePage == 'iso')
                                        @include('admin.pages.users.forms.profile.iso_profile')
                                    @elseif($profilePage == 'isi')
                                        @include('admin.pages.users.forms.profile.isi_profile')
                                    @elseif($profilePage == 'fssai')
                                        @include('admin.pages.users.forms.profile.fssai_profile')
                                    @elseif($profilePage == 'itr')
                                        @include('admin.pages.users.forms.profile.itr_profile')
                                    @elseif($profilePage == 'taxaudit')
                                        @include('admin.pages.users.forms.profile.taxaudit_profile')
                                    @elseif($profilePage == 'tds')
                                        @include('admin.pages.users.forms.profile.tds_profile')
                                    @elseif($profilePage == 'factorylicense')
                                        @include('admin.pages.users.forms.profile.factorylicense_profile')
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
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
