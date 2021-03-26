<?php

namespace App\Http\Requests\Tenant\API\Period;

use App\Http\Requests\Tenant\API\BaseFormRequest;

class StorePeriodRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|min:5',
            'room' => 'required|string|min:4',
            'day' => 'required|string|min:6',
            'time' => 'required|string|min:10',
            'sitting_rows' => 'sometimes|integer|min:1',
            'sitting_cols' => 'sometimes|integer|min:1',
            'students' => 'required|array',
            'students.*' => 'sometimes|exists:students,id',
            'teachers' => 'required|array',
            'teachers.*' => 'sometimes|integer|exists:teachers,id',
            'administration' => 'required|array',
            'administration.*' => 'sometimes|exists:administration,id',
        ];
    }
}
