<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    
}
