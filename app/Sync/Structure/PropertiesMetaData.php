<?php
/**
 * Created by Solaiman Kmail <psokmail@gmail.com>
 */

namespace App\Sync\Structure;


use App\PropertiesMetaData as PropertiesMetaDataModel;

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

            PropertiesMetaDataModel::query()->updateOrCreate($keys, $values);
        }
    }

    protected function getAttributes($question)
    {
        return array_only($question, ['label', 'options', 'constraint', 'type']);
    }

}