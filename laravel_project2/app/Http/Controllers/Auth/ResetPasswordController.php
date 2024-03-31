<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class ResetPasswordController extends Controller
{
    public function showResetForm(Request $request, $token)
    {
        return view('admin.account.reset_password')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        // Tìm người dùng với email tương ứng
        $admin = Admin::where('email', $request->email)->first();

        // Cập nhật mật khẩu mới cho người dùng
        $admin->update([
            'password' => Hash::make($request->password),
            'password_reset_token' => null
        ]);

        // Đăng nhập người dùng sau khi đặt lại mật khẩu thành công
        Auth::login($admin);

        return redirect('/doctor')->with('status', 'Mật khẩu đã được đặt lại thành công.');
    }
}
