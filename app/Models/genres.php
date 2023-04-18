<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class genres extends Model
{
    public $guarded=['id','created_at','updated_at'];
    
    /**
     * The roles that belong to the genres
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function book(): BelongsToMany
    {
        return $this->belongsToMany(book::class);
    }
}

