<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Serial_number extends Model
{
    protected $table = 'serial_numbers';
    
    protected $fillable = ['invoice_id','reg_no','sn'];
    
}
