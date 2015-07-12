<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status_printed extends Model
{
    protected $table = 'status_printeds';
    
    protected $fillable = ['invoice_id','user_id','status'];
}
