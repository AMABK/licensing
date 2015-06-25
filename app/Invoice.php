<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model {

    //
    public function sacco() {
        return $this->belongsTo('App\Sacco');
    }

    public function vehicle() {
        return $this->belongsTo('App\Vehicle');
    }

}
