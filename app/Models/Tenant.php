<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;
use Cviebrock\EloquentSluggable\Sluggable;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasFactory, HasDatabase, HasDomains, Sluggable;

   protected $fillable = [
         "id", "school", "district", "state",
    ];

    public static function getCustomColumns(): array
    {
        return [
            "id",
            "school",
            "district",
            "state",
        ];
    }

    public function sluggable()
    {
        return [
            'id' => [
                'source' => 'school',
                'separator' => ''
            ]
        ];
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

}