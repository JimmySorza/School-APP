<?php


namespace App\Models\Tenant;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodStudent extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'period_student';

    protected $fillable = [
        'period_id',
        'student_id',
        'matrix_place_row',
        'matrix_place_col',
    ];
}
