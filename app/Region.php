<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model {

    protected $table = 'regions';
    protected $fillable = ['name'];

    public function invoice() {
        return $this->hasMany('App\Invoice');
    }
    public function agents() {
        return $this->hasMany('App\Agent');
    }

}
