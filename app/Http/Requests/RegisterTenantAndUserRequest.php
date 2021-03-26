<?php

namespace App\Http\Requests;

use App\Http\Requests\Tenant\API\BaseFormRequest;

class RegisterTenantAndUserRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'school' => 'required|max:100',
            'state' => 'required|max:50',
            'district' => 'required|max:100',
        ];
    }
}
