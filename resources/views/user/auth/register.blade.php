@extends('user.layouts.blank')
@section('seo')
    <title>Register | Sampurna Suvidha Kendra</title>
@endsection
@section('content')
    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
        <div class="container-fluid">
            <div class="row min-vh-100 flex-center g-0">
                <div class="col-lg-8 col-xxl-5 py-3 position-relative"><img class="bg-auth-circle-shape"
                        src="{{ asset('assets/img/icons/spot-illustrations/bg-shape.png') }}" alt=""
                        width="250"><img class="bg-auth-circle-shape-2"
                        src="{{ asset('assets/img/icons/spot-illustrations/shape-1.png') }}" alt="" width="150">
                    <div class="card overflow-hidden z-1">
                        <div class="card-body p-0">
                            <div class="row g-0 h-100">
                                <div class="col-md-5 text-center bg-card-gradient">
                                    <div class="position-relative p-4 pt-md-5 pb-md-7" data-bs-theme="light">
                                        <div class="bg-holder bg-auth-card-shape"
                                            style="background-image:url({{ asset('assets/img/icons/spot-illustrations/half-circle.png') }});">
                                        </div>
                                        <!--/.bg-holder-->
                                        <div class="z-1 position-relative"><a
                                                class="link-light mb-4 font-sans-serif fs-4 d-inline-block fw-bolder"
                                                href="#">Finsol</a>
                                            <p class="opacity-75 text-white">Save money and Save time with India’s largest
                                                tax and financial services software platform Sampurna Suvidha Kendra</p>
                                        </div>
                                    </div>
                                    <div class="mt-3 mb-4 mt-md-4 mb-md-5" data-bs-theme="light">
                                        <p class="pt-3 text-white">Have an account?<br>
                                            <a class="btn btn-outline-light mt-2 px-4" href="{{ route('login_page') }}">Log
                                                In</a>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-7 d-flex flex-center">
                                    <div class="p-4 p-md-5 flex-grow-1">
                                        <h3>Register</h3>
                                        <form class="needs-validation" novalidate="" method="POST"
                                            action="{{ route('register') }}">
                                            @csrf
                                            <div class="row gx-2">
                                                @if ($errors->any())
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                @endif

                                                @if (session()->has('message'))
                                                    <p class="alert alert-success alert-dismissible fade show"
                                                        role="alert">{{ session('message') }}
                                                        <button type="button" class="close" data-dismiss="alert"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </p>
                                                @endif

                                                <div class="mb-3">
                                                    <label class="form-label" for="">Name</label>
                                                    <input class="form-control" type="text" name="name"
                                                        placeholder="Enter your name" autocomplete="on" required=""
                                                        id="" />
                                                    <div class="invalid-feedback">Please Provide Name</div>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label" for="">Mobile No.</label>
                                                    <input class="form-control" type="text" name="mobile"
                                                        autocomplete="on" required="required" maxlength="10"
                                                        placeholder="Enter your mobile number" onkeypress='validate(event)'
                                                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                                        pattern="^$|^[0-9]{10}$" />
                                                    <div class="invalid-feedback">Please Provide Mobile No.</div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="email">Email</label>
                                                    <input id="email" class="form-control" type="email" name="email"
                                                        placeholder="Enter an email" />
                                                    <div class="invalid-feedback email">Please Provide Email</div>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label" for="">Password</label>
                                                    <div class="position-relative">
                                                        <input class="form-control" type="password" name="password"
                                                            oninput="checkPassword(this.value)" autocomplete="on"
                                                            minlength="8" placeholder="Min 8 character" />
                                                        <i class="far fa-eye show password-eye"></i>
                                                        <i class="far fa-eye-slash password-eye-slash"></i>
                                                    </div>
                                                    <div class="invalid-feedback password">Please Provide Password</div>
                                                </div>
                                                <script>
                                                    function checkPassword(pass) {
                                                        let regex = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/;
                                                        if (pass.length < 8) {
                                                            $("input[name='password']").addClass('is-invalid')
                                                            document.querySelector(".invalid-feedback.password").style.display = "block";
                                                            document.querySelector(".invalid-feedback.password").innerHTML = "Please enter atleast 8 character";
                                                        } else if (!regex.test(pass)) {
                                                            document.querySelector(".invalid-feedback.password").innerHTML =
                                                                "Please enter atleast one uppercase, lowercase, numeric and special character";
                                                        } else {
                                                            $("input[name='password']").removeClass('is-invalid')
                                                            document.querySelector(".invalid-feedback.password").style.display = "none";
                                                        }
                                                    }
                                                </script>

                                                <div class="mb-3">
                                                    <label class="form-label" for="">Adhaar No.</label>
                                                    <input class="form-control" type="number" maxlength="12" name="aadhaar"
                                                        placeholder="Enter your Aadhar number"
                                                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                                        pattern="^$|^[0-9]{12}$" />
                                                    <div class="invalid-feedback">Please provide correct Aadhaar Number
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="stateSelect" class="form-label">Select State:</label>
                                                    <select class="form-select" name="state" id="stateSelect" required>
                                                        <option value="">Select State</option>
                                                        @foreach ($states as $state)
                                                            <option value="{{ $state->id }}">{{ $state->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <div class="invalid-feedback">Please select a state</div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="districtSelect" class="form-label">Select
                                                        District:</label>
                                                    <select class="form-select" name="district" id="districtSelect"
                                                        required>
                                                        <option value="">Select District</option>
                                                    </select>
                                                    <div class="invalid-feedback">Please select a district</div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="blockSelect" class="form-label">Select Block:</label>
                                                    <select class="form-select" name="block" id="blockSelect" required>
                                                        <option value="">Select Block</option>
                                                    </select>
                                                    <div class="invalid-feedback">Please select a block</div>
                                                </div>

                                                <div class="mb-3">
                                                    <button class="btn btn-primary d-block w-100 mt-3" type="submit"
                                                        name="submit">Create</button>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main><!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->

@endsection
@section('js')
    <script>
        $('#email').blur(function() {
            var email = $(this).val();

            $.ajax({
                url: '{{url('check-unique-email')}}',
                method: 'POST',
                data: {
                    email: email,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status === 'error') {
                        $("input[name='email']").addClass('is-invalid')
                        document.querySelector(".invalid-feedback.email").style.display = "block";
                        $('.invalid-feedback.email').text(response.message);
                    } else {
                        $("input[name='email']").removeClass('is-invalid')
                        document.querySelector(".invalid-feedback.email").style.display = "none";
                    }
                }
            });
        });
    </script>
@endsection
