<?php

namespace App\Sync\Structure;


use App\PropertiesMetaData;
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
                $table->timestamps();
            });
        }
    }


    public function insertPropertiesMetaData($questions, $caseType)
    {
        foreach ($questions as $question) {

            $attributes = [
                'label' => $question['label'],
                'options' => $question['options'] ?? [],
                'constraint' => $question['constraint'] ?? null,
                'type' => $question['type']
            ];

            $keys = ['commcare_id' => $question['hashtagValue']];

            $values = [
                'case_type' => $caseType,
                'attributes' => $attributes
            ];

            PropertiesMetaData::query()
                ->updateOrCreate($keys, $values);
        }


    }


}