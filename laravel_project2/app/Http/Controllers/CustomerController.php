<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CustomerController extends Controller
{
    public function index() {

        $customers = Customer::all();

        return view('admin.customer_manage.index', [
            'customers' => $customers,
        ]);
    }

    public function edit(Customer $customer, Request $request)
    {
        //Gọi đến view để sửa
        return view('admin.customer_manage.edit', [
            'customer' => $customer
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCustomerRequest  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */

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

    public function destroy(Customer $customer, Request $request)
    {
        $customer->delete();
        return Redirect::route('customer.index');

    }


//    public function index(){
//        $patients = Patient::paginate(5);
//        return view('admin.shift_manage.index', [
//            'patients' => $patients
//        ]);
//    }
//
//    public function edit(Patient $patient){
//        $patients = Patient::all();
//        return view('admin.shift_manage.edit', [
//            'patients' => $patients
//        ]);
//    }
//
//    public function update(){
//        $patients = Patient::all();
//        return view('admin.shift_manage.index', [
//            'patients' => $patients
//        ]);
//    }
}
