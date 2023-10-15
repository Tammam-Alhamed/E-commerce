<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ordersdetailsview extends Model
{

    protected $primaryKey = 'cart_orders';
    public $table = "ordersdetailsview";
}
