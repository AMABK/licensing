<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    protected $table = 'designations';
    
    protected  $fillable = ['name', 'description'];
    
    public function users() {
        return $this->hasMany('App\User');
    }
}
