<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class address extends Model
{
    public $guarded=['id','created_at','updated_at'];


    public function address(): BelongsTo
    {
        return $this->belongsTo(address::class,'address_usersid');
    }
}
