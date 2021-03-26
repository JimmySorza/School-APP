<?php

namespace App\Http\Requests\Tenant\API\Teacher;

use App\Http\Requests\Tenant\API\BaseFormRequest;

class FetchAllTeachersRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'paginate' => 'sometimes | in:0,1'
        ];
    }

    public function messages()
    {
        return [
            'paginate.in' => 'paginate value can be either 0 or 1'
        ];
    }
}
