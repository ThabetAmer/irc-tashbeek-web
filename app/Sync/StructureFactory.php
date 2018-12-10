<?php namespace App\Sync;

use App\Sync\Structure\Firm;
use App\Sync\Structure\JobSeeker;
use App\Sync\Structure\JobOpening;

class StructureFactory
{
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
            if (is_null($case) || $this->getCaseTypeFromClass($class) === $case) {
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
        $types = array_map(function($caseType){
            return $this->getCaseTypeFromClass($caseType);
        },$this->caseTypes);

        throw_unless(
            is_null($type) || in_array($type, $types),
            \InvalidArgumentException::class,
            "Case type is invalid, use one of " . implode(', ', $types)
        );
    }

    /**
     * get case type from class
     *
     * @param $class
     * @return string
     */
    private function getCaseTypeFromClass($class)
    {
        return kebab_case(class_basename($class));
    }
}

