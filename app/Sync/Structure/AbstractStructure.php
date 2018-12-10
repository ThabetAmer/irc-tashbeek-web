<?php

namespace App\Sync\Structure;


use App\Sync\StructureFactory;

abstract class AbstractStructure
{


    public $questions = [];

    protected $tableCreation;

    /**
     * AbstractStructure constructor.
     * @param Schema $tableCreation
     */
    public function __construct(Schema $schema)
    {
        $this->schema = $schema;
    }

    abstract public function id();

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

        $caseTypes = array_flip(app(StructureFactory::class)->getCaseTypes());
        $this->schema->create(app($this->model)->getTable(), $this->questions);
        $this->schema->insertPropertiesMetaData($questionObjects, $caseTypes[get_class($this)]);

    }


}