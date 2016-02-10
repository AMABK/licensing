<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_role extends Model
{
    protected $table = 'user_roles';
    
    protected $fillable = ['role_id', 'user_id', 'assigned_by'];
    
}
