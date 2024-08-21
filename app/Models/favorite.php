<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class favorite extends Model
{
    public $table = "favorite";
    protected $primaryKey = 'favorite_id';
    public $timestamps = false;
    public $guarded=['favorite_id'];
}
