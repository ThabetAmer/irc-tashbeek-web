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
            JobSeekerCard::make('Total monthly Intakes')
                ->model(JobSeeker::class)
                ->authorize($this->isEso())
                ->count(),
            FollowUpCard::make('Total number of pending follow-ups')
                ->for(JobSeeker::class)
                ->authorize($this->isEso())
                ->count(),


            FollowUpCard::make('Total number of pending follow-ups')
                ->for(Firm::class)
                ->authorize($this->isEsso())
                ->count(),
            ValueCard::make('Current job openings') //x
                ->model(JobOpening::class)
                ->authorize($this->isEsso())
                ->count(),
            FirmCard::make('Total firm intakes per user')
                ->model(Firm::class)
                ->authorize($this->isEsso())
                ->count()
        ];

    }
}
