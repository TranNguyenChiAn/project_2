<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required'],
            'password' => ['required'],
            'phone_number' => ['required'],
            'address' => ['required'],
            'status' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'First Name is required',
            'first_name.regex' => 'First Name is not correct format',
            'last_name.required' => 'Last Name is required',
            'last_name.regex' => 'Last Name is not correct format',
            'email.required' => 'Email is required',
            'password.required' => 'Password is required',
            'phone_number.required' => 'Phone is required',
            'phone_number.regex' => 'Phone is not correct format',
            'address.required' => 'Address is required',
            'status.required' => 'Status is required',
        ];
    }
}
