<?php
/**
 * Created by Solaiman Kmail <psokmail@gmail.com>
 */

namespace App\Sync\QuestionHandler;


use App\Sync\Cases\AbstractCase;
use Carbon\Carbon;

class DateHandler implements HandlerInterface
{
    public function handle($caseData, $questionId, $question, AbstractCase $case)
    {
        $value = array_get(array_get($caseData, 'properties'), $questionId);

        if(empty($value) && isset($question['alias'])){
            $value = array_get(array_get($caseData, 'properties'), $question['alias']);
        }

        return $this->resolve($value);
    }

    public function resolve($value)
    {
        try{
            return Carbon::parse($value)->toDateTimeString();
        }catch(\Throwable $e){
            return null;
        }
    }
}