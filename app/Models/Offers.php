<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offers extends Model
{
    protected $primaryKey = 'offers_id';
    public $table = "offers";
    public $guarded=['offers_id','created_at','updated_at'];


    public function items(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(item::class,'item_offers' , 'offers_id' ,'items_id' );

    }

    public function slide(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
    return $this->belongsTo(slide::class, 'slides_id');
    }

    public function additionalImages(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ImagesOffer::class, 'images_offers', 'offers_id');
    }

    public function itemsOffer(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(itemsOffer::class, 'offers_id', );
    }
}
