<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CashAccount extends Model
{
    protected $table = "cashAccount";
    protected $primaryKey = "CashAccountID";
    const CREATED_AT = 'CreatedAt';
    const UPDATED_AT = 'UpdatedAt';
}
