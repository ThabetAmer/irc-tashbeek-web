<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Firm extends Model implements SyncableInterface
{
    use MorphToForm, Routable;

    protected $appends = [
        'details_url'
    ];

    protected $guarded = ['id'];
}
