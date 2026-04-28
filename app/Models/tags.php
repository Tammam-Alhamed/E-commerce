<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tags extends Model
{
    public $guarded=['id','created_at','updated_at'];

    public function items() {
    return $this->belongsToMany(item::class , null , 'items_id' , 'items_id')->withPivot('id');
}


}
