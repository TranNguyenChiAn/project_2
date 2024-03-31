<form method="POST" action="{{ route('password.email') }}">
    @csrf


    <div>
        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
        @error('email')
        <span>{{ $message }}</span>
        @enderror
    </div>

    <div>
        <button type="submit">
            Dặt lại mật khẩu
        </button>
    </div>
</form>
