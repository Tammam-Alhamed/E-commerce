<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PushNotification extends Model
{
    protected $primaryKey = 'notification_id';
    public $timestamps = false;
    public $table = "notification";
}
