<?php
/**
 * Created by Solaiman Kmail <psokmail@gmail.com>
 */

namespace App\Sync;


use App\PropertyMetaData as PropertyMetaDataModel;
use App\PropertyOption;

class PropertiesMetaData
{
    public function insert($questions, $caseType)
    {
        foreach ($questions as $question) {

            $keys = ['commcare_id' => $question['hashtagValue']];

            $values = [
                'case_type' => $caseType,
                'attributes' => $this->getAttributes($question)
            ];

            $property = PropertyMetaDataModel::query()->updateOrCreate($keys, $values);

            $this->insertOptions($property, $question);
        }
    }

    public function insertOptions($property, $question)
    {

        foreach ($question['options'] ?? [] as $option) {

            $keys = ['commcare_id' => $option['value']];

            $values = ['name' => $option['translations']];

            $property->options()->updateOrCreate($keys, $values);
        }

        $property->options()->whereNotIn('commcare_id', array_pluck($question['options'] ?? [], 'value'))->forceDelete();
    }


    protected function getAttributes($question)
    {
        return array_only($question, ['label', 'options', 'constraint', 'type']);
    }


}