<?php

namespace App\Http\Requests\Tenant\API\Student;

use App\Http\Requests\Tenant\API\BaseFormRequest;
use Illuminate\Validation\Rule;

class PatchStudentRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'id' => 'required | exists:students,id',
            'first_name' => 'sometimes',
            'last_name' => 'sometimes',
            'id_number' => [
                'required',
                Rule::unique('students', 'id_number')->ignore($this->request->get('id')),
            ],
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
