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
    
    protected $fillable = ['reg_no', 'vehicle_make', 'category', 'group_id', 'tlb_no', 'no_of_seat'];
    
        public function group() {
        return $this->belongsTo('App\Sacco');
    }

    public function invoices()
    {
        return $this->hasMany('App\Invoice','payer_id');
    }
}
