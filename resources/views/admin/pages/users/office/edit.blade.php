@extends('admin.layouts.admin')
@section('content')
    <div class="row g-3 mb-3">
        <div class="col-md-12 col-xxl-3">
            <div class="card h-md-100 ecommerce-card-min-width">
                <div class="card-body d-flex flex-column justify-content-end">
                    <div class="row">
                        <div class="col-8">
                            <form class="needs-validation" novalidate="" action="{{ url('admin/users/editEmployee') }}"
                                method="POST">
                                @csrf
                                <div class="row">

                                    @if ($errors->any())
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    @endif

                                    @if (session()->has('message'))
                                        <p class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ session('message') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </p>
                                    @endif

                                    <div class="mb-3">
                                        <label class="form-label" for="">Name</label>
                                        <input class="form-control" required="required" type="text" name="name"
                                            autocomplete="on" required="" id="" value="{{ $employee->name }}" />
                                        <div class="invalid-feedback">Please Provide Name</div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="">Email</label>
                                        <input class="form-control" type="text" required="required" name="email"
                                            autocomplete="on" required="" id=""
                                            value="{{ $employee->email }}" />
                                        <div class="invalid-feedback">Please Provide Email</div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="typeofuser" class="form-label">Select Type Of User:</label>
                                        <select class="form-select" name="type_of_user" required id="typeofuser">
                                            <option value="">Type Of User</option>
                                            <option value="Head Office"
                                                {{ $employee->type_of_user == 'Head Office' ? 'selected' : '' }}>Head Office
                                            </option>
                                            <option value="State Office"
                                                {{ $employee->type_of_user == 'State Office' ? 'selected' : '' }}>State
                                                Office</option>
                                            <option value="District Office"
                                                {{ $employee->type_of_user == 'District Office' ? 'selected' : '' }}>
                                                District Office</option>
                                            <option value="Block Office"
                                                {{ $employee->type_of_user == 'Block Office' ? 'selected' : '' }}>Block
                                                Office</option>
                                        </select>
                                    </div>
                                    @if ($states)
                                        <div class="mb-3 d-none" id="select-state">
                                            <label for="stateSelect" class="form-label">Select State:</label>
                                            <select class="form-select" name="state" id="stateSelect">
                                                <option value="">Select State</option>
                                                @foreach ($states as $state)
                                                    <option value="{{ $state->id }}" {{$em_state->id === $state->id ? 'selected' : ''}}>{{ $state->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                    @if (($employee->type_of_user == 'District Office' || $employee->type_of_user == 'Block Office') && $districts)
                                        <div class="mb-3 d-none" id="select-district">
                                            <label for="districtSelect" class="form-label">Select District:</label>
                                            <select class="form-select" name="district" id="districtSelect">
                                                <option value="">Select District</option>
                                                @foreach ($districts as $district)
                                                    <option value="{{ $district->d_code }}" {{$em_district->d_code === $district->d_code ? 'selected' : ''}}>{{ $district->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                    @if ($employee->type_of_user == 'Block Office' && $blocks)
                                        <div class="mb-3 d-none" id="select-block">
                                            <label for="blockSelect" class="form-label">Select Block:</label>
                                            <select class="form-select" name="block" id="blockSelect">
                                                <option value="">Select Block</option>
                                                @foreach ($blocks as $block)
                                                    <option value="{{ $block->id }}" {{$em_block->id === $block->id ? 'selected' : ''}}>{{ $block->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                    <div class="mb-3">
                                        <button class="btn btn-primary d-block w-100 mt-3" type="submit"
                                            name="submit">Update Employee</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('#typeofuser').change(function() {
                var selected = $(this).val();
                switch (selected) {
                    case "State Office":
                        $('#select-state').removeClass('d-none');
                        break;
                    case "District Office":
                        $('#select-state').removeClass('d-none');
                        $('#select-district').removeClass('d-none');
                        break;
                    case "Block Office":
                        $('#select-state').removeClass('d-none');
                        $('#select-district').removeClass('d-none');
                        $('#select-block').removeClass('d-none');
                        break;
                    default:
                        $('#select-state').addClass('d-none');
                        $('#select-district').addClass('d-none');
                        $('#select-block').addClass('d-none');
                }
            })

            $('#stateSelect').change(function() {

                var stateId = $(this).val();
                if (stateId) {
                    $.ajax({
                        url: '{{ url('admin/get-districts') }}/' + stateId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#districtSelect').empty().append(
                                '<option value="">Select District</option>');
                            $.each(data, function(key, value) {
                                $('#districtSelect').append('<option value="' + value
                                    .d_code + '">' + value.name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#districtSelect').empty().append('<option value="">Select District</option>');
                    $('#blockSelect').empty().append('<option value="">Select Block</option>');
                }
            });

            $('#districtSelect').change(function() {
                var districtId = $(this).val();
                if (districtId) {
                    $.ajax({
                        url: '{{ url('admin/get-blocks') }}/' + districtId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#blockSelect').empty().append(
                                '<option value="">Select Block</option>');
                            $.each(data, function(key, value) {
                                $('#blockSelect').append('<option value="' + value.id +
                                    '">' + value.name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#blockSelect').empty().append('<option value="">Select Block</option>');
                }
            });
        });
    </script>
@endsection
