<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class StoreSpecializationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['require']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required'
        ];
    }
}
