<div id="form-table"
    data-list='{"valueNames":["id","name","mobile","aadhaar","email","type","status"],"page":15,"pagination":true}'>
    <div class="row justify-content-start g-2">
        <div class="col-md-auto col-sm-12 mb-3 mt-4">
            <form>
                <div class="input-group">
                    <input class="form-control form-control-sm shadow-none search" type="search" placeholder="Search..."
                        aria-label="search" />
                    <div class="input-group-text bg-transparent">
                        <span class="fa fa-search fs--1 text-600"></span>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="table-responsive scrollbar">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <table class="table table-bordered table-striped fs--1 mb-0">
            <thead class="bg-200 text-900">
                <tr>
                    <th class="sort" data-sort="id">ID</th>
                    <th class="sort" data-sort="name">Name</th>
                    <th class="sort" data-sort="mobile">Mobile</th>
                    <th class="sort" data-sort="aadhaar">Aadhaar</th>
                    <th class="sort" data-sort="email">Email</th>
                    <th class="sort" data-sort="type">Type</th>
                    <th class="sort" data-sort="status">Status</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody class="list">
                @foreach ($forms as $keyname => $form)
                    <?php $user = App\Models\User::where('id', $form['user_id'])->first(); ?>
                    <tr>
                        <td class="id">{{ $form['user_id'] }}</td>
                        <td class="name">
                            <a href="{{ url('admin/user/profile/' . $user->id) }}">
                                {{ $user['name'] }}
                            </a>
                        </td>
                        <td class="mobile">
                            {{ $user['mobile'] }}
                        </td>
                        <td class="aadhaar">
                            {{ $user['aadhaar'] }}
                        </td>
                        <td class="email">
                            {{ $user['email'] }}
                        </td>
                        <td class="type">
                            {{ $form['type'] }}
                        </td>
                        <td class="status">
                            @if ($form->status == 2)
                                <div><span class="badge badge rounded-pill d-block p-2 badge-subtle-warning">Query
                                        Raised<span class="ms-1 fas fa-stream"
                                            data-fa-transform="shrink-2"></span></span>

                                </div>
                            @elseif ($form->status == 3)
                                <div><span class="badge badge rounded-pill d-block p-2 badge-subtle-warning">Query
                                        Updated<span class="ms-1 fas fa-stream"
                                            data-fa-transform="shrink-2"></span></span>
                                </div>
                            @elseif ($form->status == 4)
                                <span class="badge badge rounded-pill d-block p-2 badge-subtle-success">Approved<span
                                        class="ms-1 fas fa-check" data-fa-transform="shrink-2"></span></span>
                            @else
                                <span class="badge badge rounded-pill d-block p-2 badge-subtle-primary">Processing
                                    <span class="ms-1 fas fa-redo" data-fa-transform="shrink-2">
                                    </span>
                                </span>
                            @endif
                        </td>
                        <td class="detail">
                            <a href="{{ $url . '/' . $form->id }}">
                                Details
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="row align-items-center mt-3">
        <div class="pagination d-none"></div>
        <div class="col">
            <p class="mb-0 fs--1">
                <span class="d-none d-sm-inline-block" data-list-info="data-list-info"></span>
                <span class="d-none d-sm-inline-block"> &mdash;</span>
                <a class="fw-semi-bold" href="#!" data-list-view="*" data-btn="show-more">View all<span
                        class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a><a
                    class="fw-semi-bold d-none" href="#!" data-list-view="less">View
                    Less<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
            </p>
        </div>
        <div class="col-auto d-flex">
            <button class="btn btn-sm btn-primary" type="button" data-list-pagination="prev">
                <span>Previous</span>
            </button>
            <button class="btn btn-sm btn-primary px-4 ms-2" type="button" data-list-pagination="next">
                <span>Next</span>
            </button>
        </div>
    </div>
</div>
