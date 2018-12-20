<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobOpening extends Model implements SyncableInterface
{
    use MorphToForm, HasFilter;

    protected $guarded = ['id'];


    public function firm()
    {
        return $this->belongsTo(Firm::class);
    }
}
