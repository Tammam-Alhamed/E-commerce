<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class itemsOffer extends Model
{
    protected $table = 'item_offers';
    public $timestamps = false;
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function offer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Offers::class, 'offers_id', 'offers_id');
    }
}
