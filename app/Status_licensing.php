<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status_licensing extends Model
{
    protected $table = 'status_licensings';
     
    protected $fillable = ['invoice_id','user_id','status'];
    
    public function invoice() {
        return $this->belongsTo('App\Invoice');
    }
}
