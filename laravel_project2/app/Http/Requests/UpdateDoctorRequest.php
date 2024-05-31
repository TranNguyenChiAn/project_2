<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDoctorRequest extends FormRequest
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
            'contact_number' => ['required'],
            'address' => ['required'],
            'specialization' => ['required'],
            'gender' => ['required'],
            'image' => ['required'],
            //
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'First Name is required',
            'name.regex' => 'First Name is not correct format',
            'email.required' => 'Email is required',
            'contact_number.required' => 'Phone is required',
            'contact_number.regex' => 'Phone is not correct format',
            'address.required' => 'Address is required',
            'specialization.required' => 'Department is required',
            'gender.required' => 'Gender is required',
        ];
    }
}
