<?php namespace App\Sync;

use App\Sync\Cases\AbstractCase;
use App\Sync\Cases\Firm;
use App\Sync\Cases\JobMatching;
use App\Sync\Cases\JobSeeker;
use App\Sync\Cases\JobOpening;

class StructureFactory
{
    use CaseVerification;

    protected $caseTypes = [
        Firm::class,
        JobSeeker::class,
        JobOpening::class,
        JobMatching::class,
    ];

    /**
     * @var StructureRequest
     */
    protected $request;

    /**
     * @var Schema
     */
    private $schema;

    /**
     * @var PropertiesMetaData
     */
    private $propertiesMetaData;

    /**
     * StructureFactory constructor.
     * @param StructureRequest $request
     * @param Schema $schema
     * @param PropertiesMetaData $propertiesMetaData
     */
    public function __construct(StructureRequest $request, Schema $schema, PropertiesMetaData $propertiesMetaData)
    {
        $this->request = $request;
        $this->schema = $schema;
        $this->propertiesMetaData = $propertiesMetaData;
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
                $this->generate($modules->get($object->id()),$object);
            }
        }
    }

    /**
     * Generate Case Structure
     *
     * @param array $data
     * @param AbstractCase $case
     */
    protected function generate(array $data, AbstractCase $case){

        $questionObjects = [];

        foreach ($data['forms'] as $form) {
            foreach ($form['questions'] as $question) {
                if (isset($case->questions()[$question['hashtagValue']])) {
                    $questionObjects[] = $question;
                }
            }
        }
        $model = $case->model();

        $this->schema->generate((new $model)->getTable(), $case->questions());

        $this->propertiesMetaData->insert($questionObjects, $case->caseType());
    }
}

