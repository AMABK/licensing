<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model {

    /** The database table used by the model.
     *
     * @var string
     */
    protected $table = 'groups';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['reg_id', 'type_id', 'name', 'phone_no', 'email', 'postal_address', 'physical_address', 'user_id'];
    public function vehicles()
    {
        return $this->hasMany('App\Vehicle');
    }
    public function invoices() {
        return $this->hasMany('App\Invoice','payer_id');
    }

    public function vehicle_type() {
        return $this->belongsTo('App\Vehicle_type','type_id','id');
    }
}
