<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class auther extends Model
{
    public $guarded=['id','created_at','updated_at'];

    /**
     * Get all of the comments for the auther
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function book(): HasMany
    {
        return $this->hasMany(book::class);
    }
}
