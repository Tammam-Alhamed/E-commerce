<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class price extends Model
{
    public $table = "price";
    public $guarded=['id'];
    use HasFactory;
}
