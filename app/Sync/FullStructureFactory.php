<?php namespace App\Sync;

use App\Models\Form;
use App\Sync\Cases\AbstractCase;
use App\Sync\Cases\Firm;
use App\Sync\Cases\Match;
use App\Sync\Cases\JobSeeker;
use App\Sync\Cases\JobOpening;

class FullStructureFactory extends StructureFactory
{
    /**
     * Get white listed questions from CommCare response data
     *
     * @param $data
     * @param $case
     * @return array
     */
    protected function getCaseQuestions(array $data, AbstractCase $case) : array
    {
        $questionObjects = [];

        foreach ($data['forms'] as $form) {
            if ($this->isWhiteListedForm($form['unique_id'], $case->formId())) {
                foreach ($form['questions'] as $question) {
                    $questionObjects[] = $this->getCaseQuestion($question,$case);
                }
            }

            Form::create([
                'name' => $form['name'],
                'commcare_id' => $form['unique_id']
            ]);
        }

        return collect($questionObjects)->keyBy(function($question){
            return $question['case_question']['name'];
        })->values()->toArray();
    }

    protected function getCaseQuestion($question, $case)
    {

        $commcareFieldName = base_commcare_field_name($question['hashtagValue']);

        if (isset($case->questions()[$commcareFieldName])) {
            $question['case_question'] = $case->questions()[$commcareFieldName];
        } else {
            $question['case_question'] = [
                'name' => $commcareFieldName,
                // (string) will exceed the row size limit on large columns
                'type' => 'text'
            ];
        }
        if ($question['case_question']['name'] === 'id') {
            $question['case_question']['name'] = 'case_id';
        }
        return $question;
    }
}

