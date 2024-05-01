<title>Admin Register</title>
@vite(["resources/sass/app.scss", "resources/js/app.js"])

<title> Register </title>
<section style="font-family: Inter">
    <img height="100%" width="100%" class="float-end top-0 position-absolute object-fit-cover"
         src="{{ asset('')}}">
    <div class="position-absolute top-50 start-50 translate-middle-y">
        <form method="post" action="{{ route('admin.registerProcess') }}"
              class="form-control rounded-4 px-xl-5 " novalidate
              style="z-index: 3;width: 150%;border: none">
            @csrf
            @method('post')
            <div class="my-4 text-center">
                <h1 style="font-weight: bold; color:#2F2FFE">REGISTER</h1>
            </div>
            <div class="form-group mb-3">
                <label class="form-label">Name:</label>
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
        </form>

        <div class="text-white" style="z-index: 3; width: 120%">
            <div class="form-text d-flex align-items-center justify-content-between"
                 style="z-index: 2">
                <div style="z-index: 2;">
                    <span class="text-white">Already have an account!</span>
                    <b><i>
                            <a class="text-white" href="{{route('admin.login')}}">Login</a>
                        </i></b>
                </div>
            </div>
        </div>
    </div>
</section>


