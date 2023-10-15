<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class orders extends Model
{
    protected $primaryKey = 'orders_id';
    public $timestamps = false;
    public $guarded=['orders_id'];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'orders_usersid');
    }
}
