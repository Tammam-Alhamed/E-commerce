<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class coupon extends Model
{
    public $table = "coupon";
    protected $primaryKey = 'coupon_id';
    public $timestamps = false;
    public $guarded=['coupon_id'];
}
