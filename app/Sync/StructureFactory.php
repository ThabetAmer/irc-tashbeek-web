<?php namespace App\Sync;

use App\Sync\Structure\Firm;
use App\Sync\Structure\JobSeeker;
use App\Sync\Structure\JobOpening;

class StructureFactory
{
    use CaseVerification;

    protected $caseTypes = [
        Firm::class,
        JobSeeker::class,
        JobOpening::class,
    ];

    /**
     * @var StructureRequest
     */
    protected $request;

    /**
     * StructureFactory constructor.
     * @param StructureRequest $request
     */
    public function __construct(StructureRequest $request)
    {
        $this->request = $request;
    }

    /**
     * @param null $case
     * @throws \Throwable
     */
    public function make($case = null)
    {
        $this->verifyCaseType($case);

        $modules = $this->request->getModules();

        $modules = collect($modules)->keyBy('unique_id');

        foreach ($this->caseTypes as $class) {
            if (is_null($case) || $this->getTypeFromClass($class) === $case) {
                $object = app($class);
                $object->handle($modules->get($object->id()));
            }
        }
    }
}

