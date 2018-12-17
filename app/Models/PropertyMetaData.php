<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyMetaData extends Model
{

    protected $table = 'properties_meta_data';

    protected $fillable = [
        'commcare_id',
        'case_type',
        'attributes',
        'order'
    ];

    protected $casts = [
        'attributes' => 'array',
        'has_filter' => 'boolean'
    ];

    public function scopeOfType($query, $type)
    {
        return $query->where('case_type', '=', $type);
    }

    public function options()
    {
        return $this->hasMany(PropertyOption::class);
    }


    public function columnName()
    {
        $column = explode('/',$this->commcare_id);
        return end($column);
    }

}
