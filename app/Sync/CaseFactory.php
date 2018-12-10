<?php namespace App\Sync;

use App\Sync\Cases\Firm;
use App\Sync\Cases\JobOpening;
use App\Sync\Cases\JobSeeker;

class CaseFactory
{
    use CaseVerification;

    protected $caseTypes = [
        JobSeeker::class,
        Firm::class,
        JobOpening::class,
    ];

    /**
     * @var StructureRequest
     */
    private $request;

    /**
     * StructureFactory constructor.
     * @param CaseRequest $request
     */
    public function __construct(CaseRequest $request)
    {
        $this->request = $request;
    }

    /**
     * @param null $caseType
     * @throws \Throwable
     */
    public function make($caseType)
    {
        $this->verifyCaseType($caseType);

        $case = app($this->getClassFromType($caseType));

        $case->handle(
            $this->request->getCases($case->caseType())
        );
    }
}

