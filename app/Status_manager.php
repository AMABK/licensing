<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status_manager extends Model
{
    protected $table = 'status_managers';
     
    protected $fillable = ['invoice_id','user_id','status'];
    
    public function invoice() {
        return $this->belongsTo('App\Invoice');
    }
}
