<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Career extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function careerPlacements(): HasMany
    {
        return $this->hasMany(CareerPlacement::class, 'career_id', 'id');
    }
}
