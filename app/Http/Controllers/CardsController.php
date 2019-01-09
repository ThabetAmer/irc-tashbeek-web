<?php

namespace App\Http\Controllers;

use App\Http\Cards\ValueCard;
use App\Http\Resources\NoteResource;
use App\Models\Firm;

class CardsController extends Controller
{

    public function cards()
    {
        return [
            ValueCard::make("Count of firms")
                ->model(Firm::class)
                ->avg()
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
