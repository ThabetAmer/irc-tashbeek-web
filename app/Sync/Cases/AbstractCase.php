<?php namespace App\Sync\Cases;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractCase
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * CommCare module ID
     *
     * @return mixed
     */
    abstract public function id(): string;

    /**
     * CommCare questions
     *
     * @return array
     */
    abstract public function questions(): array;

    /**
     * Case type saved on CommCare side
     *
     * @return string
     */
    public function caseType(): string
    {
        return case_type(static::class);
    }

    /**
     * Return model
     *
     * @return string
     */
    public function model(): string
    {
        return $this->model;
    }

    /**
     * Fetch only one form data
     */
    public function formId()
    {
        return null;
    }
}