<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeUserAccount extends Model
{
    protected $table = "employeeUserAccount";
    protected $primaryKey = "EmployeeID";
    const CREATED_AT = 'CreatedAt';
    const UPDATED_AT = 'UpdatedAt';
}
