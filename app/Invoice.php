<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model {
    use SoftDeletes;

    protected $table = 'invoices';
    
    protected $fillable = ['invoice_no', 'no_vehicle', 'discount', 'total_fee', 'payer_id', 'invoice_type', 'expiry_date', 'licensed_vehicles', 'region_id', 'agent_id', 'description', 'user_id'];
    
    public function group() {
        return $this->belongsTo('App\Group','payer_id');
    }

    public function vehicle() {
        return $this->belongsTo('App\Vehicle','payer_id');
    }
    public function region() {
        return $this->belongsTo('App\Region');
    }
    public function agent() {
        return $this->belongsTo('App\Agent');
    }
    public function status_finance() {
        return $this->hasOne('App\Status_finance');
    }
    public function status_manager() {
        return $this->hasOne('App\Status_manager');
    }

}
