<?php
/**
 * Created by Solaiman Kmail <psokmail@gmail.com>
 */

namespace App\Sync\QuestionHandler;


use App\Models\JobOpening;
use App\Sync\Cases\AbstractCase;

class MatchJobOpeningIdHandler implements HandlerInterface
{

    public function handle($caseData, $questionId, $question, AbstractCase $case)
    {
        $jobId = array_get($caseData,'properties.job_id');
        $jobOpening = JobOpening::where('job_id', $jobId)->first();

        if(!$jobOpening){
            return null;
        }

        return $jobOpening->id;
    }
}