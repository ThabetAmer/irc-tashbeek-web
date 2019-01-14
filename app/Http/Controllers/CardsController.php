<?php

namespace App\Http\Controllers;

use App\Http\Cards\Cards;

class CardsController extends Controller
{


    /**
     * @return array
     */
    public function cards()
    {
        return (new Cards)->get();
    }

    public function index()
    {
        $cardsData = [];
        foreach ($this->cards() as $card) {
            if (!$card->isAuthorized()) {
                continue;
            }
            $cardsData[] = $card->toArray();
        }
        return $cardsData;
    }


}
