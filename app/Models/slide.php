<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class slide extends Model
{
    protected $primaryKey = 'slides_id';
    public $table = "slides";
    public $guarded=['slides_id'];
}
