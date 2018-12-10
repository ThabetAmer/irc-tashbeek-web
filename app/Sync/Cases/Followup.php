<?php namespace App\Sync\Cases;


class Followup extends AbstractCase
{
    public function handle()
    {

    }

    /**
     * Case type required for to call endpoint filtered by class case type
     *
     * @return string
     */
    public function caseType(): string
    {
        return 'followup';
    }
}