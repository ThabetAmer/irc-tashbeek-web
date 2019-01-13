<?php

namespace App\Http\Controllers;

use App\Http\Cards\ValueCard;
use App\Http\Resources\NoteResource;
use App\Models\Firm;
use App\Models\Followup;
use App\Models\JobOpening;

class CardsController extends Controller
{

    public function cards()
    {
        return [
            ValueCard::make('Total Number Of Firms')
                ->model(Firm::class)
                ->count(),
            ValueCard::make('Total number of follow-ups')
                ->model(Followup::class)
                ->count(),
            ValueCard::make('Current job openings')
                ->model(JobOpening::class)
                ->count()
        ];
    }

    public function index()
    {
        $cardsData = [];
        foreach ($this->cards() as $card) {
            $cardsData[] = $card->toArray();
        }
        return $cardsData;
    }


}
