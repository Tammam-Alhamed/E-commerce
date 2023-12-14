<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class color extends Model
{
    protected $primaryKey = 'colors_id';
    public $table = "colors";
    public $guarded=['colors_id'];
    public $timestamps = false;
}
