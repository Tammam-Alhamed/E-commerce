<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagesOffer extends Model
{
    protected $table = 'images_offers';
    public $timestamps = false;
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function offer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Offers::class, 'images_offers', 'images_offers');
    }
}
