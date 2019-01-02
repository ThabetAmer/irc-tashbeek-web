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
        'order',
        'column_name'
    ];

    protected $casts = [
        'attributes' => 'array',
        'has_filter' => 'boolean'
    ];

    public function scopeTypeIs($query, $type)
    {
        return $query->where('case_type', '=', $type);
    }

    public function scopeColumnIs($query, $columnName)
    {
        return $query->where('column_name', '=', $columnName);
    }

    public function options()
    {
        return $this->hasMany(PropertyOption::class);
    }

    public function type()
    {
        return strtolower(array_get($this->getAttribute('attributes'), 'type'));
    }

    public function columnName()
    {
        $column = explode('/', $this->commcare_id);
        return end($column);
    }

}
