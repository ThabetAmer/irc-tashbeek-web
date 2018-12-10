<?php
/**
 * Created by Solaiman Kmail <psokmail@gmail.com>
 */

namespace App\Sync\Cases;


abstract class AbstractCase
{
    /**
     * Case type required to call endpoint filtered by class case type
     *
     * @return string
     */
    abstract public function caseType() : string;

    protected function prepareProperties(array $properties){
        dd(
            $properties
        );
    }
}