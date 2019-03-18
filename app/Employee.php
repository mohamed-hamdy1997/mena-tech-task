<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public $table = 'employees';
    public $timestamps =false;

    public function company(){
        return $this->belongsTo(Company::class);
    }
}
