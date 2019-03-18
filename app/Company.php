<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public $table = 'companies';
    public $timestamps =false;

    public function employee(){
        return $this->hasMany(Employee::class);
    }
}
