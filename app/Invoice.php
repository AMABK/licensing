<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model {

    protected $table = 'invoices';
    
    protected $fillable = ['invoice_no', 'no_vehicle', 'discount', 'total_fee', 'payer_id', 'invoice_type', 'expiry_date', 'licensed_vehicles', 'description', 'user_id'];
    
    public function group() {
        return $this->belongsTo('App\Group','payer_id');
    }

    public function vehicle() {
        return $this->belongsTo('App\Vehicle','payer_id');
    }

}
