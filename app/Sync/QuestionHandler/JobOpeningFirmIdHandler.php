<?php
/**
 * Created by Solaiman Kmail <psokmail@gmail.com>
 */

namespace App\Sync\QuestionHandler;


use App\Models\Firm;
use App\Sync\Cases\AbstractCase;

class JobOpeningFirmIdHandler implements HandlerInterface
{

    public function handle($caseData, $questionId, $question, AbstractCase $case)
    {
        $firmId = array_get($caseData, 'indices.parent.case_id');

        $firm = Firm::byCommCareId($firmId)->first();

        return $this->resolve($firm);
    }

    public function resolve($value)
    {
        if (!$value) {
            return null;
        }

        return $value->id;
    }
}