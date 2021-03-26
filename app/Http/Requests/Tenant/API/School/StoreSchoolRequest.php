<?php

namespace App\Http\Requests\Tenant\API\School;

use App\Http\Requests\Tenant\API\BaseFormRequest;

class StoreSchoolRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'name' => 'required',
            'phone_number' => 'required',
            'address_line_1' => 'required',
            'city' => 'required',
            'state' => 'required',
            'district' => 'sometimes',
            'zip_code' => 'required',
        ];
    }
}
