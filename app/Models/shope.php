<?php

namespace App\Models;

use App\Models\categorie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class shope extends Model
{
    protected $primaryKey = 'shopes_id';
    public $timestamps = false;
    public $guarded=['shopes_id','categories_datetime','categories_datetime'];

    // use HasFactory;
    public function categorie(): HasMany
    {
        return $this->hasMany(categorie::class);
    }
}
