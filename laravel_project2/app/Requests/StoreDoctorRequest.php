<?php

namespace App\Requests;

use App\Http\Controllers\Controller;

class StoreDoctorRequest extends Controller
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
            'name' => ['required'],
            'email' => ['required'],
            'gender' => ['required'],
            'specialization' =>['required'],
            'contact_number' => ['required'],
            'address' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'gender.required' => 'Gender is required',
            'specialization' => 'Specialization is required',
            'contact_number.required' => 'Phone is required',
            'address.required' => 'Address is required'
        ];
    }
}
