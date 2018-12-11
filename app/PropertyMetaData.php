<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyMetaData extends Model
{

    protected $table = 'properties_meta_data';

    protected $fillable = [
        'commcare_id',
        'case_type',
        'attributes',

    ];

    protected $casts = [
        'attributes' => 'array',
    ];

    public function scopeOfType($query, $type)
    {
        return $query->where('case_type', '=', $type);
    }

    public function options()
    {
        return $this->hasMany(PropertyOption::class);
    }


}
