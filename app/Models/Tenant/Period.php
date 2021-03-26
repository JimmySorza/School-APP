<?php


namespace App\Models\Tenant;


use App\Http\Models\Tenant\Administration;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "room",
        "day",
        "time",
        "sitting_rows",
        "sitting_cols",
        "no_of_students",
        "no_of_teachers",
        "no_of_administration",
    ];

    public function getTeachersStringAttribute()
    {
        return implode(',', $this->teachers->map(function ($row) {
            return $row->first_name;
        })->toArray());
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, PeriodStudent::class, 'period_id', 'student_id');
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, PeriodTeacher::class, 'period_id', 'teacher_id');
    }

    public function administration()
    {
        return $this->belongsToMany(Administration::class, PeriodAdministration::class, 'period_id', 'administration_id');
    }
}
