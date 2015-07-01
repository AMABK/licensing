<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sacco extends Model {

    /** The database table used by the model.
     *
     * @var string
     */
    protected $table = 'saccos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['reg_id', 'name','type', 'phone_no', 'email', 'address', 'no_vehicle', 'yr_of_license', 'expiry_date', 'fee_paid'];
    public function vehicles()
    {
        return $this->hasMany('App\Vehicle');
    }
    public function invoices() {
        return $this->hasMany('App\Invoice');
    }

}
