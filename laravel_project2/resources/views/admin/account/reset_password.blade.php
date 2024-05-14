@vite(["resources/sass/app.scss", "resources/js/app.js"])

<title> Reset password </title>
<section style="font-family: Inter">
    <div class="w-50">
        <form method="post" action="{{ route('password.update') }}"
              class="form-control rounded-4" novalidate
              style="z-index: 3;border: none; margin: 20% 0 0 60%; width: 80%">
            @csrf
            @method('post')
            <div class="my-4 text-center">
                <h1 style="font-weight: bold; color:#2F2FFE">Enter Email</h1>
            </div>
            @error('email')
            <span>{{ $message }}</span>
            @enderror
            <div class="mb-3">
                <input type="email" name="email" class="form-control"
                       placeholder="Email address" required
                       value="{{ old('email') }}">
            </div>
            @error('password')
            <span>{{ $message }}</span>
            @enderror
            <div class="mb-3">
                <input type="password" name="password" class="form-control" autocomplete="new-password"
                       placeholder="New password" required
                       value="{{ old('password') }}">
            </div>
            <div class="mb-3">
                <input type="password" name="password_confirmation" class="form-control"
                       placeholder="Re-enter new password" required
                       value="{{ old('password') }}">
            </div>

            <div class="mb-3 d-flex justify-content-center">
                <button class="col-md-12 btn px-4 align-content-center"
                        style="background-color: #2F2FFE; color:white; font-weight: bold">
                    Reset password
                </button>
            </div>
        </form>
    </div>
</section>
