<?php namespace App\Sync\QuestionHandler;

use App\Sync\Cases\AbstractCase;

interface HandlerInterface
{
    public function handle($caseData, $questionId, $question, AbstractCase $case);
}