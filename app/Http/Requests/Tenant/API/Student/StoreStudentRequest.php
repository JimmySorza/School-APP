<?php

namespace App\Http\Requests\Tenant\API\Student;

use App\Http\Requests\Tenant\API\BaseFormRequest;

class StoreStudentRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'id_number' => 'required | unique:students,id_number',
            'email' => 'sometimes | email',
            'phone_number' => 'sometimes',
            'address_line_1' => 'sometimes',
            'country' => 'sometimes',
            'city' => 'sometimes',
            'state' => 'sometimes',
            'zip_code' => 'sometimes',
        ];
    }
}
