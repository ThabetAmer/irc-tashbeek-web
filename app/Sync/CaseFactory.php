<?php namespace App\Sync;

use App\Sync\Cases\Firm;
use App\Sync\Cases\Followup;
use App\Sync\Cases\JobOpening;
use App\Sync\Cases\JobSeeker;

class CaseFactory
{
    protected $caseTypes = [
        'jobseeker' => JobSeeker::class,
        'firm' => Firm::class,
        'job-opening' => JobOpening::class,
        'followup' => Followup::class
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

        $case = app($this->caseTypes[$caseType]);

        $case->handle(
            $this->request->getCases($case->caseType())
        );
    }

    /**
     * @param $caseType
     * @throws \Throwable
     */
    public function verifyCaseType($caseType)
    {
        $caseTypes = array_keys($this->caseTypes);

        throw_unless(
            in_array($caseType, $caseTypes),
            \InvalidArgumentException::class,
            "Case type is invalid, use one of " . implode(', ', $caseTypes)
        );
    }
}

