@extends('admin.layouts.admin')

@section('content')

    <div class="row g-3 mb-3">
        <div class="col-md-12 col-xxl-3">
            <div class="card h-md-100 ecommerce-card-min-width">
                <div class="card-header pb-0">
                    <h4 class="mb-0 mt-2 d-flex align-items-center">All Form Details</h4>
                </div>
                <div class="card-body d-flex flex-column justify-content-end">

                    @if (session('success'))
                        <div class="alert alert-success border-2 d-flex align-items-center" role="alert">
                            <div class="bg-success me-3 icon-item"><span class="fas fa-check-circle text-white fs-3"></span>
                            </div>
                            <p class="mb-0 flex-1">{{ session('success') }}</p>
                            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (Auth::user()->type_of_user === 'Head Office')
                        <div class="d-flex align-items-center">
                            <h6 class="mb-1">Filter</h6>
                            <a href="{{ url()->current() }}?form_type={{ request('form_type') }}"
                                class="btn btn-primary btn-sm ms-auto">Reset Filter</a>
                            <button id="btnExport" type="button" class="btn btn-success btn-sm ms-2">
                                <i class="fa fa-file-csv"></i> Export to CSV
                            </button>
                        </div>
                        <form action="" class="row">
                            <input type="hidden" name="form_type" value="{{ request('form_type') }}">
                            <div class="col-md-3 col-12">
                                <select class="form-select form-select-sm mb-3" id="filter-select-state" name="state">
                                    @if (request()->has('state') && request('state') != null)
                                        @foreach ($states as $state)
                                            <option value="{{ $state->id }}"
                                                @if ((int) request('state') === $state->id) selected @endif>
                                                {{ $state->name }}
                                            </option>
                                        @endforeach
                                    @else
                                        <option selected="" value="">Select State</option>
                                        @foreach ($states as $state)
                                            <option value="{{ $state->id }}">{{ $state->name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="col-md-3 col-12 px-3">
                                <select class="form-select form-select-sm mb-3" id="filter-select-district" name="district">
                                    @if (request()->has('state') && request('state') != null)
                                        @if (request()->has('district') && request('district') == null)
                                            <option selected="" value="">Select District</option>
                                        @endif
                                        @foreach ($districts as $district)
                                            <option value="{{ $district->d_code }}"
                                                @if (request()->has('district') && (int) request('district') === $district->d_code) selected @endif>
                                                {{ $district->name }}
                                            </option>
                                        @endforeach
                                    @else
                                        <option selected="" value="">Select District</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-3 col-12">
                                <select class="form-select form-select-sm mb-3" id="filter-select-block" name="block">
                                    @if (request()->has('district') && request('district') != null)
                                        @if (request()->has('block') && request('block') == null)
                                            <option selected="" value="">Select Block</option>
                                        @endif
                                        @foreach ($blocks as $block)
                                            <option value="{{ $block->id }}"
                                                @if (request()->has('block') && (int) request('block') === $block->id) selected @endif>
                                                {{ $block->name }}
                                            </option>
                                        @endforeach
                                    @else
                                        <option selected="" value="">Select Block</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-3 col-12">
                                <button class="btn btn-primary btn-sm" type="submit">
                                    <i class="fas fa-filter"></i>
                                </button>
                            </div>
                        </form>
                    @endif
                    @include('admin.pages.forms.list')

                </div>
            </div>
        </div>
    </div>

@endsection
