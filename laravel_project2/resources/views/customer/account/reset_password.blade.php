<form method="POST" action="{{ route('password.update') }}">
    @csrf

    <div>
        <label for="password">Email: </label>
        <input id="email" type="email" name="email" required autocomplete="email"><br>
        <label for="password">Mật khẩu mới: </label>
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
