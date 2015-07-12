<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle_type extends Model {

    protected $table = 'vehicle_types';

    public function groups() {
        return $this->belongsTo('App\Group','group_type');
    }
    public function charge()
    {
        return $this->hasOne('App\Charge');
    }
    public function vehicles()
    {
        return $this->hasOne('App\Vehicle');
    }
}
