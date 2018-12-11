<?php

namespace App\Sync;


use Illuminate\Support\Facades\Schema as schemaBlueprint;
use Illuminate\Database\Schema\Blueprint;

class Schema
{
    public function create($tableName, $fields)
    {
        // check if table is not already exists
        if (!schemaBlueprint::hasTable($tableName)) {
            schemaBlueprint::create($tableName, function (Blueprint $table) use ($fields, $tableName) {
                $table->increments('id');
                foreach ($fields as $field) {
                    $table->{$field['type']}($field['name'])->nullable();
                }
                $table->string('commcare_id',60)->index();
                $table->timestamps();
            });
        }
    }
}