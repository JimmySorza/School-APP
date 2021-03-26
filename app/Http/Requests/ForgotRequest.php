<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Tenant\API\BaseFormRequest;
class ForgotRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'email' => 'required|email'
        ];
    }
}
