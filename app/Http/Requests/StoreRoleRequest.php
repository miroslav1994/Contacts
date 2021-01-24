<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRoleRequest extends FormRequest
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
        if ($this->method() == 'POST')
            return ['name' => 'required|unique:roles,name'];
         elseif ($this->method() == 'PATCH')
            return ['name' => ['required', Rule::unique('roles')->ignore($this->role_id)]];

    }
}
