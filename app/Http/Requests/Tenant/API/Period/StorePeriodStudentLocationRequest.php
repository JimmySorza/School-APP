<?php

namespace App\Http\Requests\Tenant\API\Period;

use App\Http\Requests\Tenant\API\BaseFormRequest;

class StorePeriodStudentLocationRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'period_id' => 'required|exists:periods,id',
            'student_id' => 'required|exists:students,id',
            'matrix_place_row' => 'nullable|int|min:1',
            'matrix_place_col' => 'nullable|int|min:1',
        ];
    }
}
