<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
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
        //If is insert, elseif - update
        if ($this->method() == 'POST') {
            return [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|confirmed',
                'role_id' => 'required'
            ];
        } elseif ($this->method() == 'PATCH') {
            return [
                'name' => 'required',
                'email' => ['required', 'email', Rule::unique('users')->ignore($this->user_id)],
                'role_id' => 'required'
            ];
        }

    }
}
