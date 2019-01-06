<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Followup extends Model
{

    protected $fillable = [
        'note',
        'user_id',
        'followup_date',
        'followup_period',
        'type'
    ];
}
