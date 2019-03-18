<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roll extends Model
{
    public $table = 'rolls';

    public function user(){
        return $this->hasMany(User::class);
    }
}
