@vite(["resources/sass/app.scss", "resources/js/app.js"])

<section class="vh-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 text-black">
                {{--                <div class="px-5 ms-xl-4">--}}
                {{--                    <img src="{{ asset('./images/Fu_Xuan.webp') }}" class="rounded-circle" width="50px">--}}
                {{--                </div>--}}
                <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">
                    <form style="width: 23rem;" class="row g-3 needs-validation" novalidate
                          method="post" action="{{ route('customer.loginProcess') }}">
                        @csrf
                        <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">LOG IN</h3>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="form2Example18">Email address</label>
                            <input type="email" name="email" class="form-control form-control-lg" required />
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="form2Example28">Password</label>
                            <input type="password" name="password"
                                   required class="form-control form-control-lg" />
                        </div>

                        <div class="pt-2 mb-4">
                            <button class="btn btn-info btn-lg" style="width:22rem;color: white; font-weight: bold" type="submit">Login</button>
                        </div>

                        <div class="pt-2 mb-4">
                            <a class="nav-link link-dark" href="{{ route('password.request') }}"
                               style="font-weight: bold" type="submit">
                                Forget password
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-sm-6 px-0 d-none d-sm-block">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/img3.webp"
                     alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
            </div>
        </div>
    </div>
</section>

<script>
    (() => {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>

<script>
    let msg = '{{Session::get('alert')}}';
    let exist = '{{Session::has('alert')}}';
    if(exist){
        alert(msg);
    }
</script>

