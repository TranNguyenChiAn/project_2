<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Http\Middleware\CheckLoginAdmin;
use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;

class ForgotPasswordController extends Controller
{

    public function showLinkRequestForm()
    {
        return view('admin.account.forgot_password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = Admin::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email không tồn tại trong hệ thống.']);
        }

        // Tạo và lưu token vào cơ sở dữ liệu
        $token = Str::random(60);
        return Redirect::route('password.reset', $token);

    }

    public function showDoctorRequestForm()
    {
        return view('doctor.account.forgot_password');
    }

    public function sendResetLinkDoctorEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = Admin::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email không tồn tại trong hệ thống.']);
        }

        // Tạo và lưu token vào cơ sở dữ liệu
        $token = Str::random(60);
        return Redirect::route('password.reset', $token);

    }
}
