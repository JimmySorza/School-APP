<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodTeacher extends Model
{
    use HasFactory;

    protected $table = 'period_teacher';

    protected $fillable = [
        'period_id',
        'teacher_id'
    ];
}
