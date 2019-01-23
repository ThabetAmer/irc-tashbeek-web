<?php namespace App\Http\Cards;


use App\Http\Controllers\HasAuth;
use App\Models\Firm;
use App\Models\Followup;
use App\Models\JobOpening;
use App\Models\JobSeeker;

class Cards
{
    use HasAuth;

    public function get()
    {
        return [

            // ESO
            JobSeekerCard::make(trans('irc.total_monthly_intakes'))
                ->model(JobSeeker::class)
                ->authorize($this->isEso())
                ->count(),
            FollowUpCard::make(trans('irc.total_pending_followups'))
                ->authorize($this->isEso())
                ->count(),

            // ESSO
            FollowUpCard::make(trans('irc.total_pending_followups'))
                ->authorize($this->isEsso())
                ->count(),
            JobOpeningCard::make(trans('irc.total_job_openings'))
                ->authorize($this->isEsso())
                ->count(),
            FirmCard::make(trans('irc.total_firms_per_user'))
                ->model(Firm::class)
                ->authorize($this->isEsso())
                ->count()
        ];

    }
}
