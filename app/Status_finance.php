<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status_finance extends Model
{
     protected $table = 'status_finances';
     
    protected $fillable = ['invoice_id','user_id','status'];
    
        public function invoice() {
        return $this->belongsTo('App\Invoice');
    }
}
