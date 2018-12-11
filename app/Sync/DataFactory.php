<?php namespace App\Sync;

use App\Sync\Cases\AbstractCase;
use App\Sync\Cases\Firm;
use App\Sync\Cases\JobOpening;
use App\Sync\Cases\JobSeeker;

class DataFactory
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
     * @param DataRequest $request
     */
    public function __construct(DataRequest $request)
    {
        $this->request = $request;
    }

    /**
     * Sync case data to database
     *
     * @param null $caseType
     * @param int $page
     * @throws \Throwable
     */
    public function make($caseType, $page = 1)
    {
        $this->verifyCaseType($caseType);

        $case = app($this->getClassFromType($caseType));

        $response = $this->request->data($case->caseType(), ['page' => $page]);

        $this->saveItems($case, $response['objects']);

        if (!is_null($response['meta']['next'])) {
            $this->make($caseType, $page + 1);
        }
    }

    /**
     * Save multiple cases data
     *
     * @param AbstractCase $caseObject
     * @param $cases
     */
    protected function saveItems(AbstractCase $caseObject, $cases)
    {
        foreach ($cases as $case) {
            $this->saveItem($caseObject, $case);
        }
    }

    /**
     * Save single case data
     *
     * @param $caseObject
     * @param $case
     */
    protected function saveItem($caseObject, $case)
    {
        $data = $this->getCaseFields($caseObject, $case);

        $caseObject->model()::updateOrCreate(array_only($data, 'commcare_id'), $data);
    }

    /**
     * get the field id from fully qualified question path
     *
     * @param $path
     * @return mixed
     */
    protected function fetchQuestionIdFromPath($path)
    {
        $segments = explode('/', $path);

        return end($segments);
    }

    /**
     * Map CommCare fields to database fields
     *
     * @param AbstractCase $caseObject
     * @param $case
     * @return array
     */
    protected function getCaseFields(AbstractCase $caseObject, $case)
    {
        $data = [];

        foreach ($caseObject->questions() as $questionIdPath => $question) {
            $questionId = $this->fetchQuestionIdFromPath($questionIdPath);

            $value = array_get(array_get($case, 'properties'), $questionId);

            $data[$question['name']] = $value;
        }

        $data['commcare_id'] = $case['id'];

        return $data;
    }
}