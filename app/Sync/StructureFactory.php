<?php namespace App\Sync;

use App\Models\Form;
use App\Sync\Cases\AbstractCase;
use App\Sync\Cases\Firm;
use App\Sync\Cases\Match;
use App\Sync\Cases\JobSeeker;
use App\Sync\Cases\JobOpening;
use Illuminate\Support\Facades\Storage;

class StructureFactory
{
    use CaseVerification;

    protected $caseTypes = [
        Firm::class,
        JobSeeker::class,
        JobOpening::class,
        Match::class,
    ];

    /**
     * @var StructureRequest
     */
    protected $request;

    /**
     * @var Schema
     */
    protected $schema;

    /**
     * @var PropertiesMetaData
     */
    protected $propertiesMetaData;

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
     * @param string $case
     * @throws \Throwable
     */
    public function make(string $case = null)
    {
        $this->verifyCaseType($case);

        $modules = $this->request->getModules();

        $modules = collect($modules)->keyBy('unique_id');

        foreach ($this->caseTypes as $class) {
            if (is_null($case) || $this->getTypeFromClass($class) === $case) {
                $object = app($class);
                $this->generate($modules->get($object->id()), $object);
            }
        }
    }

    /**
     * Generate Case Structure
     *
     * @param array $data
     * @param AbstractCase $case
     */
    protected function generate(array $data, AbstractCase $case)
    {

        $questionObjects = $this->getCaseQuestions($data, $case);

        $model = $case->model();

        $caseQuestions = array_pluck($questionObjects, 'case_question');

        $this->schema->generate((new $model)->getTable(), $caseQuestions);

        $this->propertiesMetaData->insert($questionObjects, $case->caseType(), $caseQuestions);
    }

    /**
     * Get white listed questions from CommCare response data
     *
     * @param $data
     * @param $case
     * @return array
     */
    protected function getCaseQuestions(array $data, AbstractCase $case): array
    {
        $questionObjects = [];

        foreach ($data['forms'] as $form) {

            if ($this->isWhiteListedForm($form['unique_id'], $case->formId())) {
                foreach ($form['questions'] as $question) {
                    if (isset($case->questions()[base_commcare_field_name($question['hashtagValue'])])) {
                        $question['case_question'] = $case->questions()[base_commcare_field_name($question['hashtagValue'])];
                        $questionObjects[] = $question;
                    }
                }
            }

            Form::create([
                'name' => $form['name'],
                'commcare_id' => $form['unique_id']
            ]);
        }

        $questionObjects = collect($questionObjects)->keyBy(function($question){
            return base_commcare_field_name($question['hashtagValue']);
        });

        // sort questions
        $questions = [];
        foreach($case->questions() as $name => $question){
            array_push($questions,$questionObjects->get($name));
        }

        return $questions;
    }

    /**
     * Check if  the developer allowed to pull questions from this form base on "unique_id" from structure response
     *
     * @param $formId
     * @param $caseFormId
     * @return bool
     */
    protected function isWhiteListedForm($formId, $caseFormId)
    {
        if (!$caseFormId) {
            return true;
        }
        if (!is_array($caseFormId) && $formId === $caseFormId) {
            return true;
        }

        return is_array($caseFormId) && in_array($formId, $caseFormId);
    }
}

