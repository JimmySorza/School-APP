<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'id_number',
        'email',
        'phone_number',
        'address_line_1',
        'country',
        'city',
        'state',
        'zip_code',
        'trace_risk_level',
        'trace_risk_count',
        'enrolled_classes_count',
        'expertise',
    ];


    /**
     * @return string
     */
    public function getNameAttribute()
    {
        return ($this->first_name . ' ' . $this->last_name);
    }

    public function periods()
    {
        return $this->hasManyThrough(Period::class, PeriodTeacher::class, 'teacher_id', 'period_id');
    }
}
