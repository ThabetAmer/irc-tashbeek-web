<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyOption extends Model
{

    protected $table = 'properties_options';

    protected $fillable = [
        'properties_meta_data_id',
        'name',
        'commcare_id',
    ];

    protected $casts = [
        'name' => 'array',
    ];

    public function property()
    {
        return $this->belongsTo(PropertyMetaData::class);
    }

}
