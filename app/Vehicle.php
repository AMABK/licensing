<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model {

    protected $table = 'vehicles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['reg_no', 'vehicle_make', 'type_id','group_id', 'tlb_no', 'no_of_seat', 'user_id'];

    public function group() {
        return $this->belongsTo('App\Group');
    }
    public function vehicle_type() {
        return $this->belongsTo('App\Vehicle_type','type_id');
    }

    public function invoices() {
        return $this->hasMany('App\Invoice', 'payer_id');
    }

}
