<?php namespace App\Sync\QuestionHandler;

use App\Sync\Cases\AbstractCase;

interface HandlerInterface
{
    /**
     * Handle case data value, return value using resolve
     *
     * @param $caseData
     * @param $questionId
     * @param $question
     * @param AbstractCase $case
     * @return mixed
     */
    public function handle($caseData, $questionId, $question, AbstractCase $case);

    /**
     * Resolve and return the value,required on use outside the factory, so we don't need to use the case data
     *
     * @param $value
     * @return mixed
     */
    public function resolve($value);
}