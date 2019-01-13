<?php
/**
 * Created by Solaiman Kmail <psokmail@gmail.com>
 */

namespace App\Sync\QuestionHandler;


use App\Models\Match;
use App\Sync\Cases\AbstractCase;
use Carbon\Carbon;

class MatchIsCandidate implements HandlerInterface
{
    public function handle($caseData, $questionId, $question, AbstractCase $case)
    {
        $match = Match::where('commcare_id',         array_get($caseData,'id'))->first();

        if($match){
            $match = $match->is_candidate;
        }

        return $this->resolve($match);
    }

    public function resolve($value)
    {
        return boolval($value);
    }
}