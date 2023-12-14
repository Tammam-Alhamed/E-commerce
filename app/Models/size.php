<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class size extends Model
{
    protected $primaryKey = 'sizes_id';
    public $table = "sizes";
    public $guarded=['sizes_id'];
    public $timestamps = false;
}
