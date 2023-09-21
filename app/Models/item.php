<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class item extends Model
{
    protected $primaryKey = 'items_id';
    public $timestamps = false;
    public $guarded=['items_id','created_at','updated_at'];

    /**
     * Get all of the comments for the auther
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categorie(): BelongsTo
    {
        return $this->belongsTo(categorie::class,'items_cat');
    }

    public function user()
    {
        return $this->belongsToMany(user::class);
    }
}
