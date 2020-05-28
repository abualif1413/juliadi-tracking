<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\BaseModel;

class CashTopUp extends BaseModel
{
    protected $table = "cashTopUp";
    protected $primaryKey = "CashTopUpID";
}
