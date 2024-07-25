@extends('admin.layouts.admin')

@section('content')

    <div class="row g-3 mb-3">

        <div class="col-md-12 col-xxl-3">
            <div class="card h-md-100 ecommerce-card-min-width">
                <div class="card-header pb-0">
                    <h6 class="mb-0 mt-2 d-flex align-items-center">Form Payment Values</h6>
                </div>
                <div class="card-body d-flex flex-column justify-content-end">
                    @if ($values)
                        <div class="row">
                            <div class="col-12">
                                <div id="tableExample"
                                    data-list='{"valueNames":["form_type","updated_at","value"],"page":15,"pagination":true}'>
                                    <div class="table-responsive scrollbar">
                                        <table class="table table-bordered table-striped fs--1 mb-0">
                                            <thead class="bg-200 text-900">
                                                <tr>
                                                    <th scope="col">Form</th>
                                                    <th scope="col">Amount</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>

                                            <tbody class="list">
                                                @if ($values)
                                                    @foreach ($values as $detail)
                                                        <tr class="align-middle">
                                                            <td class="text-nowrap">
                                                                {{ $detail->form ? $detail->form : '--' }}</td>

                                                            <td class="text-nowrap">
                                                                <input type="number" name="form_{{ $detail->id }}"
                                                                    value="{{ $detail->value }}">
                                                            </td>
                                                            <td>
                                                                <span class="btn btn-success ml-1 mb-1 btn-sm  "
                                                                    title="Change Value" type="button"
                                                                    onclick="updateValue('form_{{ $detail->id }}', {{ $detail->id }})">
                                                                    Update
                                                                    <span class="glyphicon glyphicon-eye-open ms-1"></span>
                                                                </span>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>

                                    </div>
                                    <div class="row align-items-center mt-3">
                                        <div class="pagination d-none"></div>
                                        <div class="col">
                                            <p class="mb-0 fs--1">
                                                <span class="d-none d-sm-inline-block"
                                                    data-list-info="data-list-info"></span>
                                                <span class="d-none d-sm-inline-block"> &mdash;</span>
                                                <a class="fw-semi-bold" href="#!" data-list-view="*" data-btn="show-more">View
                                                    all<span class="fas fa-angle-right ms-1"
                                                        data-fa-transform="down-1"></span></a><a class="fw-semi-bold d-none"
                                                    href="#!" data-list-view="less">View
                                                    Less<span class="fas fa-angle-right ms-1"
                                                        data-fa-transform="down-1"></span></a>
                                            </p>
                                        </div>
                                        <div class="col-auto d-flex"><button class="btn btn-sm btn-primary" type="button"
                                                data-list-pagination="prev"><span>Previous</span></button><button
                                                class="btn btn-sm btn-primary px-4 ms-2" type="button"
                                                data-list-pagination="next"><span>Next</span></button></div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-auto ps-0">
                                <div class="echart-bar-weekly-sales h-100"></div>
                            </div>
                        </div>

                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
<script>
    function updateValue(form, id) {
        var value = $('input[name="' + form + '"]').val()
        $.ajax({
            url: "{{ url('admin/payment/update-form-value') }}",
            type: 'POST',
            data: {
                id: id,
                value: value,
                '_token': '{{ csrf_token() }}'
            },
            success: function(data) {
                console.log(data)
            }
        })
    }
</script>
