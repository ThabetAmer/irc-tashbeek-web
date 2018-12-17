<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobOpening extends Model implements SyncableInterface
{
    use MorphToForm;

    protected $guarded = ['id'];

}