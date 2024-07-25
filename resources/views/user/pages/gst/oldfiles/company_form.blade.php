  <div class="tab-pane fade" id="pill-tab-contact" role="tabpanel" aria-labelledby="contact-tab">
      <form class="needs-validation" novalidate="novalidate" action="{{ route('gst.company') }}" method="post"
          enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="gst_type" value="Company" />
          <div class="detailsmargin card-header d-flex flex-between-center bg-light py-2">
              <h6 class="detailspadding mb-0">Details of your Business</h6>
          </div>
          <div class="mt-1 row g-2">
              <div class="col-4">
                  <div class="mb-3">
                      <label class="form-label" for="form-wizard-progress-wizard-legalnamename">Trade
                          Name of
                          the
                          Business</label><input required="" class="form-control" type="text" pattern="[a-zA-Z\s]+" name="name"
                          placeholder="Trade Name of Business" id="form-wizard-progress-wizard-legalname"
                          data-wizard-validate-legal-name="true" />
                      <div class="invalid-feedback">Please provide Trade Name
                      </div>
                  </div>
              </div>
              <div class="col-4">
                  <div class="mb-3">
                      <label class="form-label" for="bootstrap-wizard-validation-wizard-email">Email
                          address
                          of company</label><input class="form-control" type="email" name="email"
                          placeholder="Email address"
                          pattern="^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$" required="required"
                          id="bootstrap-wizard-validation-wizard-email" data-wizard-validate-email="true" />
                      <div class="invalid-feedback">You must add email</div>
                  </div>
              </div>
              <div class="col-4">
                  <div class="mb-3">
                      <label class="form-label" for="form-wizard-progress-wizard-addregnum">Mobile
                          number
                          of company</label><input class="form-control" required="" type="text" pattern="[a-zA-Z\s]+" name="name"
                          placeholder="Enter Registration No" id="form-wizard-progress-wizard-addregnum" />
                      <div class="invalid-feedback">Please provide Mobile
                          number</div>
                  </div>
              </div>

              <!-- Upload for Company Images -->
              <div class="col-4">
                  <label class="form-label" for="form-wizard-progress-wizard-addregnum">Upload
                      Company PAN
                      Card</label>
                  <div class="bg-light">
                      <div class="tab-content">
                          <div class="tab-pane preview-tab-pane active" role="tabpanel"
                              aria-labelledby="tab-dom-77cd7e82-0ae3-4189-b6e8-f4e60ff78ac7"
                              id="dom-77cd7e82-0ae3-4189-b6e8-f4e60ff78ac7">
                              <div class="dropzone dropzone-multiple p-0" id="my-awesome-dropzone"
                                  data-dropzone="data-dropzone" action="#!">
                                  <div class="fallback"><input name="file" type="file" class="dropzone"
                                          data-max-files="2" multiple="multiple" />
                                  </div>
                                  <div class="dz-message" data-dz-message="data-dz-message"> <img class="me-2"
                                          src="{{ asset('assets/img/icons/cloud-upload.svg') }}" width="25"
                                          alt="" />CLick or
                                      Drop
                                      your
                                      files here
                                  </div>
                                  <div class="dz-preview dz-preview-multiple m-0 d-flex flex-column">
                                      <div class="d-flex media mb-3 pb-3 border-bottom btn-reveal-trigger">
                                          <img class="dz-image" src="{{ asset('assets/img/generic/image-file-2.png') }}"
                                              alt="..." data-dz-thumbnail="data-dz-thumbnail" />
                                          <div class="flex-1 d-flex flex-between-center">
                                              <div>
                                                  <h6 data-dz-name="data-dz-name">
                                                  </h6>
                                                  <div class="d-flex align-items-center">
                                                      <p class="mb-0 fs--1 text-400 lh-1" data-dz-size="data-dz-size">
                                                      </p>
                                                      <div class="dz-progress">
                                                          <span class="dz-upload" data-dz-uploadprogress=""></span>
                                                      </div>
                                                  </div>
                                                  <span class="fs--2 text-danger"
                                                      data-dz-errormessage="data-dz-errormessage"></span>
                                              </div>
                                              <div class="dropdown font-sans-serif">
                                                  <button
                                                      class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal dropdown-caret-none"
                                                      type="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                                      aria-expanded="false"><span
                                                          class="fas fa-ellipsis-h"></span></button>
                                                  <div class="dropdown-menu dropdown-menu-end border py-2">
                                                      <a class="dropdown-item" href="#!"
                                                          data-dz-remove="data-dz-remove">Remove
                                                          File</a>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-4">
                  <label class="form-label" for="form-wizard-progress-wizard-addregnum">Upload
                      MOA</label>
                  <div class="bg-light">
                      <div class="tab-content">
                          <div class="tab-pane preview-tab-pane active" role="tabpanel"
                              aria-labelledby="tab-dom-77cd7e82-0ae3-4189-b6e8-f4e60ff78ac7"
                              id="dom-77cd7e82-0ae3-4189-b6e8-f4e60ff78ac7">
                              <div class="dropzone dropzone-multiple p-0" id="my-awesome-dropzone"
                                  data-dropzone="data-dropzone" action="#!">
                                  <div class="fallback"><input name="file" type="file" multiple="multiple" />
                                  </div>
                                  <div class="dz-message" data-dz-message="data-dz-message"> <img class="me-2"
                                          src="{{ asset('assets/img/icons/cloud-upload.svg') }}" width="25"
                                          alt="" />CLick or
                                      Drop
                                      your
                                      files here
                                  </div>
                                  <div class="dz-preview dz-preview-multiple m-0 d-flex flex-column">
                                      <div class="d-flex media mb-3 pb-3 border-bottom btn-reveal-trigger">
                                          <img class="dz-image"
                                              src="{{ asset('assets/img/generic/image-file-2.png') }}" alt="..."
                                              data-dz-thumbnail="data-dz-thumbnail" />
                                          <div class="flex-1 d-flex flex-between-center">
                                              <div>
                                                  <h6 data-dz-name="data-dz-name">
                                                  </h6>
                                                  <div class="d-flex align-items-center">
                                                      <p class="mb-0 fs--1 text-400 lh-1" data-dz-size="data-dz-size">
                                                      </p>
                                                      <div class="dz-progress">
                                                          <span class="dz-upload" data-dz-uploadprogress=""></span>
                                                      </div>
                                                  </div>
                                                  <span class="fs--2 text-danger"
                                                      data-dz-errormessage="data-dz-errormessage"></span>
                                              </div>
                                              <div class="dropdown font-sans-serif">
                                                  <button
                                                      class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal dropdown-caret-none"
                                                      type="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                                      aria-expanded="false"><span
                                                          class="fas fa-ellipsis-h"></span></button>
                                                  <div class="dropdown-menu dropdown-menu-end border py-2">
                                                      <a class="dropdown-item" href="#!"
                                                          data-dz-remove="data-dz-remove">Remove
                                                          File</a>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-4">
                  <label class="form-label" for="form-wizard-progress-wizard-addregnum">Upload
                      AOA</label>
                  <div class="bg-light">
                      <div class="tab-content">
                          <div class="tab-pane preview-tab-pane active" role="tabpanel"
                              aria-labelledby="tab-dom-77cd7e82-0ae3-4189-b6e8-f4e60ff78ac7"
                              id="dom-77cd7e82-0ae3-4189-b6e8-f4e60ff78ac7">
                              <div class="dropzone dropzone-multiple p-0" id="my-awesome-dropzone"
                                  data-dropzone="data-dropzone" action="#!">
                                  <div class="fallback"><input name="file" type="file" multiple="multiple" />
                                  </div>
                                  <div class="dz-message" data-dz-message="data-dz-message"> <img class="me-2"
                                          src="{{ asset('assets/img/icons/cloud-upload.svg') }}" width="25"
                                          alt="" />CLick or
                                      Drop
                                      your
                                      files here
                                  </div>
                                  <div class="dz-preview dz-preview-multiple m-0 d-flex flex-column">
                                      <div class="d-flex media mb-3 pb-3 border-bottom btn-reveal-trigger">
                                          <img class="dz-image"
                                              src="{{ asset('assets/img/generic/image-file-2.png') }}" alt="..."
                                              data-dz-thumbnail="data-dz-thumbnail" />
                                          <div class="flex-1 d-flex flex-between-center">
                                              <div>
                                                  <h6 data-dz-name="data-dz-name">
                                                  </h6>
                                                  <div class="d-flex align-items-center">
                                                      <p class="mb-0 fs--1 text-400 lh-1" data-dz-size="data-dz-size">
                                                      </p>
                                                      <div class="dz-progress">
                                                          <span class="dz-upload" data-dz-uploadprogress=""></span>
                                                      </div>
                                                  </div>
                                                  <span class="fs--2 text-danger"
                                                      data-dz-errormessage="data-dz-errormessage"></span>
                                              </div>
                                              <div class="dropdown font-sans-serif">
                                                  <button
                                                      class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal dropdown-caret-none"
                                                      type="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                                      aria-expanded="false"><span
                                                          class="fas fa-ellipsis-h"></span></button>
                                                  <div class="dropdown-menu dropdown-menu-end border py-2">
                                                      <a class="dropdown-item" href="#!"
                                                          data-dz-remove="data-dz-remove">Remove
                                                          File</a>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>

              <!-- Upload for Director Images -->
              <div class="detailsmargin card-header d-flex flex-between-center bg-light py-2">
                  <h6 class="detailspadding mb-0">Upload documents of
                      Direcotrs</h6>
              </div>
              <div class="col-6">
                  <div class="mb-3">
                      <label class="form-label" for="bootstrap-wizard-validation-wizard-email">Director
                          Email</label><input class="form-control" type="email" name="email"
                          placeholder="Email address"
                          pattern="^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$" required="required"
                          id="bootstrap-wizard-validation-wizard-email" data-wizard-validate-email="true" />
                      <div class="invalid-feedback">You must add email</div>
                  </div>
              </div>
              <div class="col-6">
                  <div class="mb-3">
                      <label class="form-label" for="form-wizard-progress-wizard-addregnum">Director
                          Mobile number registered with aadhar
                          of the firm</label><input class="form-control" required="" type="text"
                          name="name" placeholder="Enter Registration No"
                          id="form-wizard-progress-wizard-addregnum" />
                      <div class="invalid-feedback">Please provide Mobile
                          number</div>
                  </div>
              </div>
              <div class="col-4">
                  <label class="form-label" for="form-wizard-progress-wizard-addregnum">Upload PAN
                      Card</label>
                  <div class="bg-light">
                      <div class="tab-content">
                          <div class="tab-pane preview-tab-pane active" role="tabpanel"
                              aria-labelledby="tab-dom-77cd7e82-0ae3-4189-b6e8-f4e60ff78ac7"
                              id="dom-77cd7e82-0ae3-4189-b6e8-f4e60ff78ac7">
                              <div class="dropzone dropzone-multiple p-0" id="my-awesome-dropzone"
                                  data-dropzone="data-dropzone" action="#!">
                                  <div class="fallback"><input name="file" type="file" multiple="multiple" />
                                  </div>
                                  <div class="dz-message" data-dz-message="data-dz-message"> <img class="me-2"
                                          src="{{ asset('assets/img/icons/cloud-upload.svg') }}" width="25"
                                          alt="" />CLick or
                                      Drop
                                      your
                                      files here
                                  </div>
                                  <div class="dz-preview dz-preview-multiple m-0 d-flex flex-column">
                                      <div class="d-flex media mb-3 pb-3 border-bottom btn-reveal-trigger">
                                          <img class="dz-image"
                                              src="{{ asset('assets/img/generic/image-file-2.png') }}" alt="..."
                                              data-dz-thumbnail="data-dz-thumbnail" />
                                          <div class="flex-1 d-flex flex-between-center">
                                              <div>
                                                  <h6 data-dz-name="data-dz-name">
                                                  </h6>
                                                  <div class="d-flex align-items-center">
                                                      <p class="mb-0 fs--1 text-400 lh-1" data-dz-size="data-dz-size">
                                                      </p>
                                                      <div class="dz-progress">
                                                          <span class="dz-upload" data-dz-uploadprogress=""></span>
                                                      </div>
                                                  </div>
                                                  <span class="fs--2 text-danger"
                                                      data-dz-errormessage="data-dz-errormessage"></span>
                                              </div>
                                              <div class="dropdown font-sans-serif">
                                                  <button
                                                      class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal dropdown-caret-none"
                                                      type="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                                      aria-expanded="false"><span
                                                          class="fas fa-ellipsis-h"></span></button>
                                                  <div class="dropdown-menu dropdown-menu-end border py-2">
                                                      <a class="dropdown-item" href="#!"
                                                          data-dz-remove="data-dz-remove">Remove
                                                          File</a>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-4">
                  <label class="form-label" for="form-wizard-progress-wizard-addregnum">Upload
                      Aadhar
                      Card</label>
                  <div class="bg-light">
                      <div class="tab-content">
                          <div class="tab-pane preview-tab-pane active" role="tabpanel"
                              aria-labelledby="tab-dom-77cd7e82-0ae3-4189-b6e8-f4e60ff78ac7"
                              id="dom-77cd7e82-0ae3-4189-b6e8-f4e60ff78ac7">
                              <div class="dropzone dropzone-multiple p-0" id="my-awesome-dropzone"
                                  data-dropzone="data-dropzone" action="#!">
                                  <div class="fallback"><input name="file" type="file" multiple="multiple" />
                                  </div>
                                  <div class="dz-message" data-dz-message="data-dz-message"> <img class="me-2"
                                          src="{{ asset('assets/img/icons/cloud-upload.svg') }}" width="25"
                                          alt="" />CLick or
                                      Drop
                                      your
                                      files here
                                  </div>
                                  <div class="dz-preview dz-preview-multiple m-0 d-flex flex-column">
                                      <div class="d-flex media mb-3 pb-3 border-bottom btn-reveal-trigger">
                                          <img class="dz-image"
                                              src="{{ asset('assets/img/generic/image-file-2.png') }}" alt="..."
                                              data-dz-thumbnail="data-dz-thumbnail" />
                                          <div class="flex-1 d-flex flex-between-center">
                                              <div>
                                                  <h6 data-dz-name="data-dz-name">
                                                  </h6>
                                                  <div class="d-flex align-items-center">
                                                      <p class="mb-0 fs--1 text-400 lh-1" data-dz-size="data-dz-size">
                                                      </p>
                                                      <div class="dz-progress">
                                                          <span class="dz-upload" data-dz-uploadprogress=""></span>
                                                      </div>
                                                  </div>
                                                  <span class="fs--2 text-danger"
                                                      data-dz-errormessage="data-dz-errormessage"></span>
                                              </div>
                                              <div class="dropdown font-sans-serif">
                                                  <button
                                                      class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal dropdown-caret-none"
                                                      type="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                                      aria-expanded="false"><span
                                                          class="fas fa-ellipsis-h"></span></button>
                                                  <div class="dropdown-menu dropdown-menu-end border py-2">
                                                      <a class="dropdown-item" href="#!"
                                                          data-dz-remove="data-dz-remove">Remove
                                                          File</a>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-4">
                  <label class="form-label" for="form-wizard-progress-wizard-addregnum">Upload Voter
                      ID Card
                      / Passport</label>
                  <div class="bg-light">
                      <div class="tab-content">
                          <div class="tab-pane preview-tab-pane active" role="tabpanel"
                              aria-labelledby="tab-dom-77cd7e82-0ae3-4189-b6e8-f4e60ff78ac7"
                              id="dom-77cd7e82-0ae3-4189-b6e8-f4e60ff78ac7">
                              <div class="dropzone dropzone-multiple p-0" id="my-awesome-dropzone"
                                  data-dropzone="data-dropzone" action="#!">
                                  <div class="fallback"><input name="file" type="file" multiple="multiple" />
                                  </div>
                                  <div class="dz-message" data-dz-message="data-dz-message"> <img class="me-2"
                                          src="{{ asset('assets/img/icons/cloud-upload.svg') }}" width="25"
                                          alt="" />CLick or
                                      Drop
                                      your
                                      files here
                                  </div>
                                  <div class="dz-preview dz-preview-multiple m-0 d-flex flex-column">
                                      <div class="d-flex media mb-3 pb-3 border-bottom btn-reveal-trigger">
                                          <img class="dz-image"
                                              src="{{ asset('assets/img/generic/image-file-2.png') }}" alt="..."
                                              data-dz-thumbnail="data-dz-thumbnail" />
                                          <div class="flex-1 d-flex flex-between-center">
                                              <div>
                                                  <h6 data-dz-name="data-dz-name">
                                                  </h6>
                                                  <div class="d-flex align-items-center">
                                                      <p class="mb-0 fs--1 text-400 lh-1" data-dz-size="data-dz-size">
                                                      </p>
                                                      <div class="dz-progress">
                                                          <span class="dz-upload" data-dz-uploadprogress=""></span>
                                                      </div>
                                                  </div>
                                                  <span class="fs--2 text-danger"
                                                      data-dz-errormessage="data-dz-errormessage"></span>
                                              </div>
                                              <div class="dropdown font-sans-serif">
                                                  <button
                                                      class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal dropdown-caret-none"
                                                      type="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                                      aria-expanded="false"><span
                                                          class="fas fa-ellipsis-h"></span></button>
                                                  <div class="dropdown-menu dropdown-menu-end border py-2">
                                                      <a class="dropdown-item" href="#!"
                                                          data-dz-remove="data-dz-remove">Remove
                                                          File</a>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-4">
                  <label class="form-label" for="form-wizard-progress-wizard-addregnum">Upload
                      Driving
                      License</label>
                  <div class="bg-light">
                      <div class="tab-content">
                          <div class="tab-pane preview-tab-pane active" role="tabpanel"
                              aria-labelledby="tab-dom-77cd7e82-0ae3-4189-b6e8-f4e60ff78ac7"
                              id="dom-77cd7e82-0ae3-4189-b6e8-f4e60ff78ac7">
                              <div class="dropzone dropzone-multiple p-0" id="my-awesome-dropzone"
                                  data-dropzone="data-dropzone" action="#!">
                                  <div class="fallback"><input name="file" type="file" multiple="multiple" />
                                  </div>
                                  <div class="dz-message" data-dz-message="data-dz-message"> <img class="me-2"
                                          src="{{ asset('assets/img/icons/cloud-upload.svg') }}" width="25"
                                          alt="" />CLick or
                                      Drop
                                      your
                                      files here
                                  </div>
                                  <div class="dz-preview dz-preview-multiple m-0 d-flex flex-column">
                                      <div class="d-flex media mb-3 pb-3 border-bottom btn-reveal-trigger">
                                          <img class="dz-image"
                                              src="{{ asset('assets/img/generic/image-file-2.png') }}" alt="..."
                                              data-dz-thumbnail="data-dz-thumbnail" />
                                          <div class="flex-1 d-flex flex-between-center">
                                              <div>
                                                  <h6 data-dz-name="data-dz-name">
                                                  </h6>
                                                  <div class="d-flex align-items-center">
                                                      <p class="mb-0 fs--1 text-400 lh-1" data-dz-size="data-dz-size">
                                                      </p>
                                                      <div class="dz-progress">
                                                          <span class="dz-upload" data-dz-uploadprogress=""></span>
                                                      </div>
                                                  </div>
                                                  <span class="fs--2 text-danger"
                                                      data-dz-errormessage="data-dz-errormessage"></span>
                                              </div>
                                              <div class="dropdown font-sans-serif">
                                                  <button
                                                      class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal dropdown-caret-none"
                                                      type="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                                      aria-expanded="false"><span
                                                          class="fas fa-ellipsis-h"></span></button>
                                                  <div class="dropdown-menu dropdown-menu-end border py-2">
                                                      <a class="dropdown-item" href="#!"
                                                          data-dz-remove="data-dz-remove">Remove
                                                          File</a>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-4">
                  <label class="form-label" for="form-wizard-progress-wizard-addregnum">Upload
                      Photograph</label>
                  <div class="bg-light">
                      <div class="tab-content">
                          <div class="tab-pane preview-tab-pane active" role="tabpanel"
                              aria-labelledby="tab-dom-77cd7e82-0ae3-4189-b6e8-f4e60ff78ac7"
                              id="dom-77cd7e82-0ae3-4189-b6e8-f4e60ff78ac7">
                              <div class="dropzone dropzone-multiple p-0" id="my-awesome-dropzone"
                                  data-dropzone="data-dropzone" action="#!">
                                  <div class="fallback"><input name="file" type="file" multiple="multiple" />
                                  </div>
                                  <div class="dz-message" data-dz-message="data-dz-message"> <img class="me-2"
                                          src="{{ asset('assets/img/icons/cloud-upload.svg') }}" width="25"
                                          alt="" />CLick or
                                      Drop
                                      your
                                      files here
                                  </div>
                                  <div class="dz-preview dz-preview-multiple m-0 d-flex flex-column">
                                      <div class="d-flex media mb-3 pb-3 border-bottom btn-reveal-trigger">
                                          <img class="dz-image"
                                              src="{{ asset('assets/img/generic/image-file-2.png') }}" alt="..."
                                              data-dz-thumbnail="data-dz-thumbnail" />
                                          <div class="flex-1 d-flex flex-between-center">
                                              <div>
                                                  <h6 data-dz-name="data-dz-name">
                                                  </h6>
                                                  <div class="d-flex align-items-center">
                                                      <p class="mb-0 fs--1 text-400 lh-1" data-dz-size="data-dz-size">
                                                      </p>
                                                      <div class="dz-progress">
                                                          <span class="dz-upload" data-dz-uploadprogress=""></span>
                                                      </div>
                                                  </div>
                                                  <span class="fs--2 text-danger"
                                                      data-dz-errormessage="data-dz-errormessage"></span>
                                              </div>
                                              <div class="dropdown font-sans-serif">
                                                  <button
                                                      class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal dropdown-caret-none"
                                                      type="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                                      aria-expanded="false"><span
                                                          class="fas fa-ellipsis-h"></span></button>
                                                  <div class="dropdown-menu dropdown-menu-end border py-2">
                                                      <a class="dropdown-item" href="#!"
                                                          data-dz-remove="data-dz-remove">Remove
                                                          File</a>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-4">
              </div>
          </div>
          <div class="mt-1 row g-2">
              <button class="adddirector btn btn-primary me-1 mb-1" type="button">
                  <span class="fas fa-plus me-1" data-fa-transform="shrink-3"></span>Add Director
              </button>
          </div>
          <br />
          <br />
          <div class="col-4">
              <div class="mb-3">
                  <button class="btn btn-primary me-1 mb-1" type="submit">Submit & Pay</button>
                  <p>Amount: ₹{{ $amount }}</p>
              </div>
          </div>
      </form>
  </div>
