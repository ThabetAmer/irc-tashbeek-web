<?php

namespace App\Sync\Structure;


use App\Sync\StructureFactory;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractStructure
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * @var array
     */
    public $questions = [];

    /**
     * @var Schema
     */
    protected $schema;

    /**
     * @var PropertiesMetaData
     */
    private $propertiesMetaData;

    /**
     * AbstractStructure constructor.
     *
     * @param Schema $schema
     * @param PropertiesMetaData $propertiesMetaData
     */
    public function __construct(Schema $schema, PropertiesMetaData $propertiesMetaData)
    {
        $this->schema = $schema;

        $this->propertiesMetaData = $propertiesMetaData;
    }

    /**
     * CommCare module ID
     *
     * @return mixed
     */
    abstract public function id();

    /**
     * Case type saved on CommCare side
     *
     * @return string
     */
    public function caseType()
    {
        return kebab_case(class_basename(static::class));
    }

    /**
     * Handle structure generation
     *
     * @param $data
     */
    public function handle($data)
    {
        $questionObjects = [];

        foreach ($data['forms'] as $form) {
            foreach ($form['questions'] as $question) {
                if (isset($this->questions[$question['hashtagValue']])) {
                    $questionObjects[] = $question;
                }
            }
        }

        $this->schema->create((new $this->model)->getTable(), $this->questions);

        $this->propertiesMetaData->insert($questionObjects, $this->caseType());
    }
}