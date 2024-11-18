<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OutletHasService extends Model
{
     protected $guarded = [];

     public function service(): BelongsTo
     {
         return $this->belongsTo(Service::class, 'service_id', 'id');
     }
}
