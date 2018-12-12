<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Match extends Model implements SyncableInterface
{
    protected $guarded = ['id'];

}
