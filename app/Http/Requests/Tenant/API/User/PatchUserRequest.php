<?php

namespace App\Http\Requests\Tenant\API\User;

use App\Http\Requests\Tenant\API\BaseFormRequest;

class PatchUserRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'id' => 'required|exists:users,id',
            'first_name' => 'sometimes|string|min:4|max:50',
            'last_name' => 'sometimes|string|min:4|max:50',
            'password' => 'sometimes|string|min:6|confirmed',
        ];
    }
}
