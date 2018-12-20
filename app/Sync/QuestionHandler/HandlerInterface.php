<?php namespace App\Sync\QuestionHandler;

use App\Sync\Cases\AbstractCase;

interface HandlerInterface
{
    public function handle($caseData, $question, AbstractCase $case);

    public function resolve($attribute, $record);
}