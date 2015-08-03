<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model {

    //
    protected $table = 'agents';
    protected $fillable = ['name', 'phone_no', 'region_id', 'postal_address'];

    public function invoice() {
        return $this->hasMany('App\Invoice');
    }
    public function region()
    {
        return $this->belongsTo('App\Region','region_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
