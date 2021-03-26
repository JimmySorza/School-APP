<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone_number',
        'address_line_1',
        'city',
        'state',
        'email',
        'district',
        'zip_code',
        'trace_count',
    ];
}
