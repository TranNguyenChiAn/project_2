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
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function login(){
        return view('admin.account.login');
    }

    public function loginProcess(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email'=>'required',
            'password'=> 'required'
        ], [
            'email.required'=>'Email can not be empty',
            'password.required'=>'Password can not be empty',
        ]);

        if($validator->fails()){
            return redirect()->route('admin.login')->withErrors($validator)->withInput();
        }

        $loginInfor = ['email' => $request->email, 'password' => $request->password];

        if(Auth::guard('admin')->attempt($loginInfor)){

            //Lấy thông tin của admin đang login
            $admin = Auth::guard('admin')->user();
            //Cho login
            Auth::guard('admin')->login($admin);
            //Ném thông tin customer đăng nhập lên session
            session(['admin' => $admin]);
//            $request->session()->regenerate();
            return redirect()->route('appointment.showData');
        }
        return Redirect::back() ->with('alert','Wrong password');
    }

    public function register (){
        return view('admin.account.register');
    }

    public function registerProcess (Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email'=>'required|unique:customers',
            'password'=> 'required'
        ], [
            'name.required' => 'Name can not be empty',
            'email.required'=>'Email can not be empty',
            'password.required'=>'Password can not be empty',
            'email.unique'=>'Email has been exist',
        ]);

        if($validator->fails()){
            return redirect()->route('admin.register')->withErrors($validator)->withInput();
        }

        $admin = new Admin();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->setPasswordAttributes($request->password);
        $admin->save();

        return redirect()->route('admin.login');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        session()->forget('admin');
        return Redirect::route('admin.login');
    }

}


