<?php

namespace App\Models\Tenant;

use App\Models\Tenant\Period;
use App\Models\Tenant\PeriodAdministration;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administration extends Model
{
    use HasFactory;

    protected $table = 'administration';

    protected $fillable = [
        "first_name",
        "last_name",
        "id_number",
        "email",
        "phone_number",
        "address_line_1",
        "country",
        "city",
        "state",
        "zip_code",
        "trace_risk_level",
        "trace_risk_count",
        "position",
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
        return $this->hasManyThrough(Period::class, PeriodAdministration::class, 'administration_id', 'period_id');
    }
}
