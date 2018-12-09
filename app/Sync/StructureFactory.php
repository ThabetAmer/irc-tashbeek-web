<?php namespace App\Sync;

use App\Sync\Structure\JobSeeker;

class StructureFactory
{
    protected $caseTypes = [
        'jobseeker' => JobSeeker::class,
        'firm' => JobSeeker::class,
        'job-opening' => JobSeeker::class,
        'followup' => JobSeeker::class
    ];
    /**
     * @var StructureRequest
     */
    private $request;

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



        foreach($this->caseTypes as $type => $class){
            if(is_null($case) || $type === $case){
                app($class)->handle();
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

