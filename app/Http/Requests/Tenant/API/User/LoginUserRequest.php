<?php

namespace App\Http\Requests\Tenant\API\User;

use App\Http\Requests\Tenant\API\BaseFormRequest;

class LoginUserRequest extends BaseFormRequest
{
    public function rules()
    {
        $role = 'super-admin';
        return [
            'username' => 'required|exists:users,username,role,'.$role,
            'password' => 'required',
        ];
    }
}
