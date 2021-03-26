<?php

namespace App\Http\Requests\Tenant\API\User;

use App\Http\Requests\Tenant\API\BaseFormRequest;

class RegisterUserRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'first_name' => 'required|string|min:3|max:50',
            'last_name' => 'required|string|min:3|max:50',
            'phone_number' => 'required|max:20',
            'email' => 'required|string|email|unique:users|max:255',
            'username' => 'required|string|unique:users|max:255',
            'password' => 'required|string|min:6|confirmed',
        ];
    }
}
