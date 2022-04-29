<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'department';
    protected $primaryKey = 'id';

     public function doctor()
    {      
        return $this->hasmany('App\Model\Doctor', 'department_id', 'id');
    }

     public function service()
    {      
        return $this->hasmany('App\Model\DepartService', 'department_id', 'id');
    }
}
?>