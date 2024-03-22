<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    public function login(){
        return view('admin.account.login');
    }

    public function loginProcess(Request $request)
    {

        $account = $request->only(['email', 'password']);
        $check = Auth::guard('admin')->attempt($account);

        if ($check) {
            //Lấy thông tin của admin đang login
            $admin = Auth::guard('admin')->user();
            //Cho login
            Auth::guard('admin')->login($admin);
            //Ném thông tin admin đăng nhập lên session
            session(['admin' => $admin]);
            return Redirect::route('doctor');
        } else {
            //cho quay về trang login
            return Redirect::back() ->with('alert','Wrong password');
        }
    }


    public function logout()
    {
        Auth::guard('admin')->logout();
        session()->forget('admin');
        return Redirect::route('admin.login');
    }

    public function forgotPassword()
    {
        return view('admin.account.login');
    }
}


