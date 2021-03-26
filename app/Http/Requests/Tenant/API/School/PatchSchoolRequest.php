<?php

namespace App\Http\Requests\Tenant\API\School;

use App\Http\Requests\Tenant\API\BaseFormRequest;

class PatchSchoolRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'id' => 'required | exists:schools,id',
            'name' => 'sometimes',
            'phone_number' => 'sometimes',
            'address_line_1' => 'sometimes',
            'city' => 'sometimes',
            'state' => 'sometimes',
            'district' => 'sometimes',
            'zip_code' => 'sometimes',
        ];
    }
}
