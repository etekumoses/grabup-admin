<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $casts = [
        'status' => 'integer',

    ];

    public function scopeActive($query)
    {
        return $query->where('status', '=', 1);
    }

// category can have many jobs 
public function job()
{      
    return $this->hasmany('App\Model\Job', 'cat_id', 'id');
}

}
