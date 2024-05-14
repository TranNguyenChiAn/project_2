@vite(["resources/sass/app.scss", "resources/js/app.js"])

<title>Customer Register </title>
<section style="font-family: Inter">
    <!-- Background image -->
    <div class="p-4">
        <img src="{{asset('./images/cus_register_bg.jpg')}}" style="height: 360px; width: 100%">
    </div>
    <!-- Background image -->

    <div class="card shadow-lg" style="
        margin: -26% auto auto 15%;
        backdrop-filter: blur(30px);
        width: 70%">
        <div class="card-body py-5 px-md-5">
            <div class="w-50">
                <form method="post" action="{{ route('customer.registerProcess') }}"
                      class="form-control" novalidate
                      style="border: none; width: 70%; margin: auto auto auto 66%">
                    @csrf
                    @method('post')
                    <div class="text-center">
                        <h1 style="font-weight: bold; color:#2F2FFE">Sign up now</h1>
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" name="name" class="form-control"
                               placeholder="Full name"
                               value="{{ old('name') }}">
                    </div>
                    @if($errors -> has('name'))
                        <div class="md-3">
                            <span class="text-danger"> {{ $errors -> first('name') }} </span>
                        </div>
                    @endif

                    @if($errors -> has('email'))
                        <div class="">
                            <span class="text-danger"> {{ $errors -> first('email') }} </span>
                        </div>
                    @endif
                    <div class="mb-3">
                        <input type="email" name="email" class="form-control"
                               placeholder="Email address"
                               value="{{ old('email') }}">
                    </div>

                    @if($errors -> has('password'))
                        <div class="">
                            <span class="text-danger"> {{ $errors -> first('password') }} </span>
                        </div>
                    @endif
                    <div class="mb-3">
                        <input type="password" name="password" class="form-control"
                               placeholder="Password"
                               value="{{ old('password') }}">
                    </div>

                    <br>
                    <div class="mb-3 d-flex justify-content-center">
                        <button class="col-md-12 btn px-4 align-content-center"
                                style="background-color: #2F2FFE; color:white; font-weight: bold">
                            Sign up
                        </button>
                    </div>
                    <!-- Register buttons -->
                    <div class="text-center">
                        <p>or sign up with:</p>
                        <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-link btn-floating mx-1">
                            <i class="bi bi-facebook"></i>
                        </button>
                        <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-link btn-floating mx-1">
                            <i class="bi bi-google"></i>
                        </button>

                        <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-link btn-floating mx-1">
                            <i class="bi bi-twitter"></i>
                        </button>

                        <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-link btn-floating mx-1">
                            <i class="bi bi-github"></i>
                        </button>
                    </div>
                </form>
                <div style="z-index: 3; width: 120%">
                    <div class="form-text d-flex align-items-center justify-content-between"
                         style="z-index: 2">
                        <div style="z-index: 2;">
                            <span class="">Already have an account!</span>
                            <b>
                                <a class="" href="{{route('customer.login')}}">Login</a>
                            </b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
</section>



