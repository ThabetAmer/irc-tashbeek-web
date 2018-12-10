<?php namespace App\Sync;

use App\Sync\Structure\Firm;
use App\Sync\Structure\Followup;
use App\Sync\Structure\JobOpening;
use App\Sync\Structure\JobSeeker;

class StructureFactory
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
     * @return array
     */
    public function getCaseTypes(): array
    {
        return $this->caseTypes;
    }

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

        foreach ($this->caseTypes as $type => $class) {
            if (is_null($case) || $type === $case) {
                $object = app($class);
                $object->handle($modules->get($object->id()));
            }
        }
    }

    /**
     * @param $type
     * @throws \Throwable
     */
    public function verifyCaseType($type)
    {
        $types = array_keys($this->caseTypes);

        throw_unless(
            is_null($type) || in_array($type, $types),
            \InvalidArgumentException::class,
            "Case type is invalid, use one of [" . implode(', ', $types) . "]"
        );
    }
}

