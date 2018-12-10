<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertiesMetaData extends Model
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

    public function ofType($query, $type)
    {
        return $query->where('case_type', '=', $type);
    }


}
