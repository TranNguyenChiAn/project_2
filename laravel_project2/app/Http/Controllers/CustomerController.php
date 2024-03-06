<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Requests\UpdateCustomerRequest;
use App\Models\Customer;

use Illuminate\Http\Request;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
     * @param  \App\Requests\UpdateCustomerRequest  $request
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
}
