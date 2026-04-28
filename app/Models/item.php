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

    public function tags()
{
    return $this->belongsToMany(tags::class , 'item_tags' , 'items_id' );
}

public function color()
{
    return $this->hasMany(color::class , 'colors_items');
}

public function size()
{
    return $this->hasMany(size::class , 'sizes_items');
}

    public function offers(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(offers::class ,'item_offers' , 'offers_id' ,'offers_id' );
    }
}
