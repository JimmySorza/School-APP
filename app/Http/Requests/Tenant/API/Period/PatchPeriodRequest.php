<?php


namespace App\Http\Requests\Tenant\API\Period;


use App\Http\Requests\Tenant\API\BaseFormRequest;

class PatchPeriodRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'id' => 'required|exists:periods,id',
            'name' => 'sometimes|string|min:5',
            'room' => 'sometimes|string|min:4',
            'day' => 'sometimes|string|min:6',
            'time' => 'sometimes|string|min:10',
            'sitting_rows' => 'sometimes|integer|min:1',
            'sitting_cols' => 'sometimes|integer|min:1',
            'students' => 'sometimes|array',
            'students.*' => 'sometimes|exists:students,id',
            'teachers' => 'sometimes|array',
            'teachers.*' => 'sometimes|exists:teachers,id',
            'administration' => 'sometimes|array',
            'administration.*' => 'sometimes|exists:administration,id',
        ];
    }
}
