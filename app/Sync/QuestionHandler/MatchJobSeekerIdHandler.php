<?php
/**
 * Created by Solaiman Kmail <psokmail@gmail.com>
 */

namespace App\Sync\QuestionHandler;


use App\Models\JobSeeker;
use App\Sync\Cases\AbstractCase;

class MatchJobSeekerIdHandler implements HandlerInterface
{

    public function handle($caseData, $questionId, $question, AbstractCase $case)
    {
        $jobSeekerId = array_get($caseData, 'indices.parent.case_id');

        $jobSeeker = JobSeeker::byCommCareId($jobSeekerId)->first();

        if (!$jobSeeker) {
            return null;
        }

        return $jobSeeker->id;
    }
}