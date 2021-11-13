<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            'first_name' => request()->isMethod('post') ? 'required' : 'nullable' . 'string|max:255',
            'family_name' => request()->isMethod('post') ? 'required' : 'nullable' . 'string|max:255',
            'last_name' => request()->isMethod('post') ? 'required' : 'nullable' . 'string|max:255',
            'birth_date' => request()->isMethod('post') ? 'required' : 'nullable' . 'date|date_format:Y-m-d',
            'disability_degree' => 'nullable|integer|max:100',
            'genre' => request()->isMethod('post') ? 'required' : 'nullable' . 'integer|min:0|max:1',
            'phone' => request()->isMethod('post') ? 'required' : 'nullable' . 'string',
            'mobile_phone' => 'nullable|string',
            'additional_contacts' => 'nullable|string',
            'status' => request()->isMethod('post') ? 'required' : 'nullable' . 'integer|min:0|max:1',
            'user_id' => request()->isMethod('post') ? 'required' : 'nullable' . 'integer|min:1'
        ];
    }
}