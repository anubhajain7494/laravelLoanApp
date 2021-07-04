<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loans extends Model
{
    protected $fillable = [
        'user_id', 'amount_required', 'loan_term'
    ];
}
