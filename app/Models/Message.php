<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['sender_name', 'content'];
}
