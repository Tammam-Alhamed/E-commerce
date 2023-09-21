<?php

namespace App\Models;

use App\Models\shope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class categorie extends Model
{
    protected $primaryKey = 'categories_id';
    public $timestamps = false;
    public $guarded=['categories_id','categories_datetime','categories_datetime'];

    /**
     * Get all of the comments for the auther
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function item(): HasMany
    {
        return $this->hasMany(item::class);
    }

    public function shope(): BelongsTo
    {
        return $this->belongsTo(shope::class,'categories_shope');
    }
}
