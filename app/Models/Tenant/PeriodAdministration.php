<?php


namespace App\Models\Tenant;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodAdministration extends Model
{
    use HasFactory;

    protected $table = 'period_administration';

    protected $fillable = [
        'period_id',
        'administration_id',
    ];
}
