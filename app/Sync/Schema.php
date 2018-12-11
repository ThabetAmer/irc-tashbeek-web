<?php

namespace App\Sync;


use Illuminate\Support\Facades\Schema as LaravelSchema;
use Illuminate\Database\Schema\Blueprint;

class Schema
{
    public function generate($tableName, $fields)
    {
        $method = LaravelSchema::hasTable($tableName) ? 'table' : 'create';

        LaravelSchema::$method($tableName, function (Blueprint $table) use ($fields,$method) {

            if($method === 'create'){
                $table->increments('id');
            }

            foreach ($fields as $field) {
                $field = $table->{$field['type']}($field['name'])->nullable();
                if ($method === 'table' && LaravelSchema::hasColumn($table->getTable(), $field['name'])) {
                    $field->change();
                }
            }

            if ($method === 'create' || !LaravelSchema::hasColumn($table->getTable(), 'commcare_id')) {
                $table->string('commcare_id', 60)->index();
            }

            if ($method === 'create') {
                $table->timestamps();
            }
        });
    }
}