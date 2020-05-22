<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequesitionSlip extends Model
{
    protected $table = "requesitionSlip";
    protected $primaryKey = "RequesitionSlipID";
    const CREATED_AT = 'CreatedAt';
    const UPDATED_AT = 'UpdatedAt';
}
