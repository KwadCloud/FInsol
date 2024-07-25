 <div class="tab-pane  px-sm-3 px-md-5" role="tabpanel" aria-labelledby="bootstrap-wizard-validation-tab2"
     id="bootstrap-wizard-validation-tab2">

     <h3>Firm</h3>
     <form class="needs-validation  " id="myDropzone" data-dropzone="data-dropzone"
         action="{{ route('gst.register.firm') }}" method="post" enctype="multipart/form-data" novalidate="novalidate">
         @csrf
         <input type="hidden" name="gst_type" value="Individual" />
         <div class="mb-3">
             <label class="form-label" for="bootstrap-wizard-validation-wizard-email">Email*</label><input
                 class="form-control" type="email" value="{{ Auth::user()->email }}" name="email_id"
                 placeholder="Email address" pattern="^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$"
                 required="required" id="bootstrap-wizard-validation-wizard-email" data-wizard-validate-email="true" />
             <div class="invalid-feedback">You must add email</div>
         </div>

         <div class="detailsmargin card-header d-flex flex-between-center bg-light py-2">
             <h6 class="detailspadding mb-0">Details of your Business</h6>
         </div>
         <br />
         <div class="row g-2">
             <div class="col-6">
                 <div class="mb-3">
                     <label class="form-label" for="form-wizard-progress-wizard-legalnamename">Trade Name of
                         the
                         Business</label><input required="" class="form-control" type="text" name="trade_name"
                         placeholder="Trade Name of Business" id="form-wizard-progress-wizard-legalname"
                         data-wizard-validate-legal-name="true" />
                     <div class="invalid-feedback">Please provide Trade Name as per PAN
                         Card</div>
                 </div>
             </div>
             <div class="col-4">
                 <div class="mb-3">
                     <label class="form-label" for="linkedaadhar">Mobile Number Linked with Aadhar Card</label>
                     <select class="form-select" aria-label="Default select example">
                         <option value="Yes">Yes</option>
                         <option value="No">No</option>
                     </select>
                 </div>
             </div>
         </div>

         <div class="detailsmargin card-header d-flex flex-between-center bg-light py-2">
             <h6 class="detailspadding mb-0">Upload All Required Documents</h6>
         </div>
         <br />
         <div class="form-group">
             <label for="field1">Field 1:</label>
             <input type="text" class="form-control" id="field1" name="field1">
         </div>

         <div class="form-group">
             <label for="image1">Image 1:</label>
             <div class="custom-file">
                 <input type="file" class="custom-file-input" id="image1" name="image1">
                 <label class="custom-file-label" for="image1">Choose file</label>
             </div>
         </div>

         <div class="form-group">
             <label for="field2">Field 2:</label>
             <input type="text" class="form-control" id="field2" name="field2">
         </div>

         <div class="form-group">
             <label for="image2">Image 2:</label>
             <div class="custom-file">
                 <input type="file" class="custom-file-input" id="image2" name="image2">
                 <label class="custom-file-label" for="image2">Choose file</label>
             </div>
         </div>

         <br />
         <div class="row g-2 ">
             <div class="card-footer bg-light">
                 <div class="col-4 mb-3">
                     <button class="btn btn-primary px-5 px-sm-6" type="submit">Save
                     </button>
                 </div>
             </div>
         </div>
     </form>
 </div>
