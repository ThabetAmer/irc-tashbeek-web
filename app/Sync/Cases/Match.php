<?php namespace App\Sync\Cases;

use App\Sync\QuestionHandler\MatchJobOpeningIdHandler;
use App\Sync\QuestionHandler\MatchJobSeekerIdHandler;

class Match extends AbstractCase
{
    public $model = \App\Models\Match::class;

    /**
     * CommCare module ID
     *
     * @return mixed
     */
    public function id(): string
    {
        return '562c52af2c135d2e1dfa57f15a478c676a6eafee';
    }

    /**
     * CommCare questions
     *
     * @return array
     */
    public function questions(): array
    {
        return [
            'job_opening_id' => [
                'column_name' => 'job_opening_id',
                'column_type' => 'text',
                'property' => true,
                'type' => 'select',
                'translations' => [
                    'en' => 'Job Opening',
                    'ara' => 'Job Opening'
                ],
                'valueHandler' => MatchJobOpeningIdHandler::class
            ],
            'job_seeker_id' => [
                'column_name' => 'job_seeker_id',
                'column_type' => 'text',
                'property' => true,
                'type' => 'select',
                'translations' => [
                    'en' => 'Job Seeker',
                    'ara' => 'Job Seeker'
                ],
                'valueHandler' => MatchJobSeekerIdHandler::class
            ],

        ];
    }

    public function caseType(): string
    {
        return 'match';
    }
}