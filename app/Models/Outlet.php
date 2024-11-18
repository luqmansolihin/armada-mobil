<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Outlet extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function OutletHasOperationalHours(): HasMany
    {
        return $this->hasMany(OutletHasOperationalHour::class, 'outlet_id', 'id');
    }

    public function OutletHasServices(): HasMany
    {
        return $this->hasMany(OutletHasService::class, 'outlet_id', 'id');
    }
}