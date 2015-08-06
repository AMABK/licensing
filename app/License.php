<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    protected $table = 'licenses';


    protected $fillable = ['invoice_id', 'sn', 'sacco', 'reg_no', 'seats', 'expiry_date', 'status'];
}
