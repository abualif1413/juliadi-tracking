<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAccountRole extends Model
{
    protected $table = "userAccountRole";
    protected $primaryKey = "EmployeeID";
    public $timestamps = false;
}
