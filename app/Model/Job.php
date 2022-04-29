<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'job';
  

// get records done by the user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // belong to a certain category
    // public function category(){
    //     return $this->belongsTo(Category::class,'cat_id');
    // }
    
    public function category()
    {      
        return $this->belongsTo('App\Model\Category', 'id', 'cat_id');
    }
}
