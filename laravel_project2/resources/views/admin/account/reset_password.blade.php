<form method="POST" action="{{ route('password.update') }}">
    @csrf

    <input type="hidden" name="token" value="{{ $token }}">

    <div>
        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}" required autofocus>
        @error('email')
        <span>{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="password">Mật khẩu mới</label>
        <input id="password" type="password" name="password" required autocomplete="new-password">
        @error('password')
        <span>{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="password_confirmation">Xác nhận mật khẩu mới</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required>
    </div>

    <div>
        <button type="submit">
            Đặt lại mật khẩu
        </button>
    </div>
</form>
