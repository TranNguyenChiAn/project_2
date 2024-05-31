@vite(["resources/sass/app.scss", "resources/js/app.js"])

<section class="vh-100" style="background-image: url({{asset('./images/185895.jpg')}}); background-size: cover">
    <div class="container">
        <div class="d-flex align-items-center h-custom-2">
            <form style="width: 30rem;background-color: transparent; backdrop-filter: blur(30px); margin: 6% 0 0 30%"
                  class="form-control row g-3 needs-validation text-white rounded-4 p-4" novalidate
                  method="post" action="{{ route('doctor.loginProcess') }}">
                @csrf
                <h3 class="fw-normal mb-3 pb-3"><b>LOG IN DOCTOR</b></h3>
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
                    <button class="btn btn-primary btn-lg" style="width: 100%;color: white;
                          font-weight: bold" type="submit">Login</button>
                </div>
                <div class="pt-2 mb-4 d-flex justify-content-between">
                    <a class="nav-link" href="{{ route('doctor.requestPw') }}"
                       style="font-weight: bold" type="submit">
                        Forgot password
                    </a>
                </div>
            </form>
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

