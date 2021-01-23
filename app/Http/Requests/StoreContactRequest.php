<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreContactRequest extends FormRequest
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
        if ($this->method() == 'POST') {
            return [
                'firstName' => 'required',
                'lastName' => 'required',
                'phone' => 'required|unique:phones, phone'
            ];
        } elseif ($this->method() == 'PATCH') {
            return [
                'firstName' => 'required',
                'lastName' => 'required',
                'phone' => ['required', Rule::unique('phones')->ignore($this->phone_id)]
            ];
        }
    }
}
