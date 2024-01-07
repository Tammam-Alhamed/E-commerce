<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class image extends Model
{
    protected $primaryKey = 'images_id';
    public $table = "images";
    public $guarded=['images_id'];
    public $timestamps = false;
}
