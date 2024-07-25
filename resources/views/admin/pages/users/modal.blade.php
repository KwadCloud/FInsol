<!-- GST Approve Modal -->
<div id="myApprovedModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('admin/user/gst/change_status') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                </div>
                <div class="modal-body">
                    <p>
                        <input type="hidden" name="userid" id="userid" value="{{ request()->segment(5) }}" />
                        <input type="hidden" id="gstid" name="gstid" value="" />
                        <input type="hidden" name="type" value="approve" />
                        <label>GST Number</label>
                        <input type="text" class="form-control" required="required" name="gst_number" value=""
                            placeholder="Enter the Gst Number" />
                        <label>Trade Name</label>
                        <input type="text" id="tradename" required="required" class="form-control" name="trade_name"
                            value="" placeholder="Trade Name" />
                    <div class="mb-3">
                        <label>Upload Doc:</label>
                        <input type="file" name="approved_img[]" id="image-upload" class="myfrm form-control" />
                    </div>
                    </p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary me-1 mb-1" type="submit">Submit</button>
                    <button type="button" class="btn btn-default close " data-dismiss="modal"
                        onclick="closeModal1()">Close</button>
                </div>
            </form>
        </div>

    </div>
</div>

<!-- GST Note Modal -->
<div id="myNoteModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <form action="{{ url('admin/user/gst/change_status') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                </div>
                <div class="modal-body">
                    <p>
                        <input type="hidden" name="userid" id="userid" value="{{ request()->segment(5) }}" />
                        <input type="hidden" id="gstid" name="gstid" value="" />
                        <input type="hidden" name="type" id="type" value="note" />
                        <!-- <input type="text" name="tradename_temp" id="tradename" value="" placeholder="Enter the Trade name" /> -->

                    <div class="mb-3">
                        <label>Enter Your Query:</label>
                        <textarea name="admin_note" required="required" style="height:90px;width:100%"></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Upload Doc:</label>
                        <input type="file" name="raised_img[]" id="image-upload" class="myfrm form-control"
                            multiple />
                    </div>
                    </p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary me-1 mb-1" type="submit">Submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"
                        onclick="closeModal2()">Close</button>
                </div>
            </form>
        </div>

    </div>
</div>

<!-- Forms Note Modal -->
<div id="myCommonNoteModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <form action="{{ url('admin/user/forms/change_status') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                </div>
                <div class="modal-body">
                    <p>
                    <div id="note-modal-body-div">

                    </div>
                    <div class="mb-3">
                        <label>Enter Your Query:</label>
                        <textarea name="admin_note" required="required" style="height:90px;width:100%"></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Upload Doc:</label>
                        <input type="file" name="raised_img[]" id="image-upload" class="myfrm form-control"
                            multiple />
                    </div>
                    </p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary me-1 mb-1" type="submit">Submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"
                        onclick="closeModal2()">Close</button>
                </div>
            </form>
        </div>

    </div>
</div>

<!-- Forms Approve Modal -->
<div id="myCommonApprovedModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('admin/user/forms/change_status') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                </div>
                <div class="modal-body">
                    <p>
                    <div id="approve-modal-body-div">

                    </div>

                    <div class="mb-3">
                        <label>Upload Doc:</label>
                        <input type="file" name="approved_img[]" id="image-upload" class="myfrm form-control" />
                    </div>
                    </p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary me-1 mb-1" type="submit">Submit</button>
                    <button type="button" class="btn btn-default close " data-dismiss="modal"
                        onclick="closeModal1()">Close</button>
                </div>
            </form>
        </div>

    </div>
</div>

<!-- Companies Act Note Modal -->
<div id="myCaCommonNoteModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <form action="{{ url('admin/user/companiesact/change_status') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                </div>
                <div class="modal-body">
                    <p>
                    <div id="ca-note-modal-body-div">

                    </div>
                    <div class="mb-3">
                        <label>Enter Your Query:</label>
                        <textarea name="admin_note" required="required" style="height:90px;width:100%"></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Upload Doc:</label>
                        <input type="file" name="raised_img[]" id="image-upload" class="myfrm form-control"
                            multiple />
                    </div>
                    </p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary me-1 mb-1" type="submit">Submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"
                        onclick="closeModal2()">Close</button>
                </div>
            </form>
        </div>

    </div>
</div>

<!-- Companies Act Approve Modal -->
<div id="myCaCommonApprovedModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('admin/user/companiesact/change_status') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                </div>
                <div class="modal-body">
                    <p>
                    <div id="ca-approve-modal-body-div">

                    </div>

                    <div class="mb-3">
                        <label>Upload Doc:</label>
                        <input type="file" name="approved_img[]" id="image-upload" class="myfrm form-control" />
                    </div>
                    </p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary me-1 mb-1" type="submit">Submit</button>
                    <button type="button" class="btn btn-default close " data-dismiss="modal"
                        onclick="closeModal1()">Close</button>
                </div>
            </form>
        </div>

    </div>
</div>

<!-- Certificate Note Modal -->
<div id="myCerCommonNoteModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <form action="{{ url('admin/user/certification/change_status') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                </div>
                <div class="modal-body">
                    <p>
                    <div id="cer-note-modal-body-div">

                    </div>
                    <div class="mb-3">
                        <label>Enter Your Query:</label>
                        <textarea name="admin_note" required="required" style="height:90px;width:100%"></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Upload Doc:</label>
                        <input type="file" name="raised_img[]" id="image-upload" class="myfrm form-control"
                            multiple />
                    </div>
                    </p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary me-1 mb-1" type="submit">Submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"
                        onclick="closeModal2()">Close</button>
                </div>
            </form>
        </div>

    </div>
</div>

<!-- Certificate Approve Modal -->
<div id="myCerCommonApprovedModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('admin/user/certification/change_status') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                </div>
                <div class="modal-body">
                    <p>
                    <div id="cer-approve-modal-body-div">

                    </div>

                    <div class="mb-3">
                        <label>Upload Doc:</label>
                        <input type="file" name="approved_img[]" id="image-upload" class="myfrm form-control" />
                    </div>
                    </p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary me-1 mb-1" type="submit">Submit</button>
                    <button type="button" class="btn btn-default close " data-dismiss="modal"
                        onclick="closeModal1()">Close</button>
                </div>
            </form>
        </div>

    </div>
</div>

<!-- Legal Note Modal -->
<div id="myLegalCommonNoteModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('admin/user/legal-work/change_status') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                </div>
                <div class="modal-body">
                    <p>
                    <div id="legal-note-modal-body-div">

                    </div>
                    <div class="mb-3">
                        <label>Enter Your Query:</label>
                        <textarea name="admin_note" required="required" style="height:90px;width:100%"></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Upload Doc:</label>
                        <input type="file" name="raised_img[]" id="image-upload" class="myfrm form-control"
                            multiple />
                    </div>
                    </p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary me-1 mb-1" type="submit">Submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"
                        onclick="closeModal2()">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Legal Approve Modal -->
<div id="myLegalCommonApprovedModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('admin/user/legal-work/change_status') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                </div>
                <div class="modal-body">
                    <p>
                    <div id="legal-approve-modal-body-div">

                    </div>

                    <div class="mb-3">
                        <label>Upload Doc:</label>
                        <input type="file" name="approved_img[]" id="image-upload" class="myfrm form-control" />
                    </div>
                    </p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary me-1 mb-1" type="submit">Submit</button>
                    <button type="button" class="btn btn-default close " data-dismiss="modal"
                        onclick="closeModal1()">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Loan Note Modal -->
<div id="myLoanCommonNoteModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('admin/user/loan-finance/change_status') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                </div>
                <div class="modal-body">
                    <p>
                    <div id="loan-note-modal-body-div">

                    </div>
                    <div class="mb-3">
                        <label>Enter Your Query:</label>
                        <textarea name="admin_note" required="required" style="height:90px;width:100%"></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Upload Doc:</label>
                        <input type="file" name="raised_img[]" id="image-upload" class="myfrm form-control"
                            multiple />
                    </div>
                    </p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary me-1 mb-1" type="submit">Submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"
                        onclick="closeModal2()">Close</button>
                </div>
            </form>
        </div>

    </div>
</div>

<!-- Loan Approve Modal -->
<div id="myLoanCommonApprovedModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('admin/user/loan-finance/change_status') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                </div>
                <div class="modal-body">
                    <p>
                    <div id="loan-approve-modal-body-div">

                    </div>

                    <div class="mb-3">
                        <label>Upload Doc:</label>
                        <input type="file" name="approved_img[]" id="image-upload" class="myfrm form-control" />
                    </div>
                    </p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary me-1 mb-1" type="submit">Submit</button>
                    <button type="button" class="btn btn-default close " data-dismiss="modal"
                        onclick="closeModal1()">Close</button>
                </div>
            </form>
        </div>

    </div>
</div>

<script>
    function closeModal1() {
        $('#myApprovedModal').modal('hide');
        $('#myCommonApprovedModal').modal('hide');
        $('#myCaCommonApprovedModal').modal('hide');
        $('#myCerCommonApprovedModal').modal('hide');
        $('#myLoanCommonApprovedModal').modal('hide');
        $('#myLegalCommonApprovedModal').modal('hide');
    }

    function closeModal2() {
        $('#myNoteModal').modal('hide');
        $('#myCommonNoteModal').modal('hide');
        $('#myCaCommonNoteModal').modal('hide');
        $('#myCerCommonNoteModal').modal('hide');
        $('#myLoanCommonNoteModal').modal('hide');
        $('#myLegalCommonNoteModal').modal('hide');
    }
</script>
