<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function index() {

        $customers = Customer::all();

        return view('admin.customer_manage.index', [
            'customers' => $customers,
        ]);
    }

    public function edit(Customer $customer)
    {
        //Gọi đến view để sửa
        return view('admin.customer_manage.edit', [
            'customer' => $customer
        ]);
    }

    public function login(){
        return view('customer.account.login');
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
            return redirect()->route('customer.login')->withErrors($validator)->withInput();
        }

        $loginInfor = ['email' => $request->email, 'password' => $request->password];

        if(Auth::guard('customer')->attempt($loginInfor)){
            //Lấy thông tin của customer đang login
            $customer = Auth::guard('customer')->user();
            //Cho login
            Auth::guard('customer')->login($customer);
            //Ném thông tin customer đăng nhập lên session
            session(['customer' => $customer]);
            return redirect()->route('index');
        }
        return Redirect::back() ->with('alert','Wrong password');
    }

    public function register (){
        return view('customer.account.register');
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
            return redirect()->route('customer.register')->withErrors($validator)->withInput();
        }

        $customer = new Customer();
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->setPasswordAttributes($request->password);
        $customer->save();

        return redirect()->route('admin.login');
    }

    public function logout()
    {
        Auth::guard('customer')->logout();
        session()->forget('customer');
        return Redirect::route('customer.login');
    }

    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        //Lấy dữ liệu trong form và update lên db
//        $array = [];
//        $array = Arr::add($array, 'name', $request->name);
//        $array = Arr::add($array, 'email', $request->email);
//        $array = Arr::add($array, 'phone', $request->phone);
//        $array = Arr::add($array, 'address', $request->address);

        $customer->update($request->all());

        return Redirect::route('customer.index');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return Redirect::route('customer.index');

    }
}
