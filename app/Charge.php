<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Charge extends Model {

    protected $table = 'charges';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['vehicle_type', 'standard_fee', 'extra_fee', 'standard_seats', 'description', 'user_id'];

    public function group() {
        return $this->belongsTo('App\Sacco');
    }

    public function invoices() {
        return $this->hasMany('App\Invoice');
    }

    public function vehicle_type() {
        return $this->belongsTo('App\Vehicle_type','type_id');
    }

}
