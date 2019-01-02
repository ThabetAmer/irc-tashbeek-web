<?php namespace App\Sync;

use App\Sync\Cases\AbstractCase;
use App\Sync\Cases\Firm;
use App\Sync\Cases\Match;
use App\Sync\Cases\JobOpening;
use App\Sync\Cases\JobSeeker;

class DataFactory
{
    use CaseVerification;

    protected $caseTypes = [
        Firm::class,
        JobSeeker::class,
        JobOpening::class,
        Match::class
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
     * @throws \Exception
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
     * @throws \Exception
     */
    protected function saveItem($caseObject, $case)
    {
        if($this->removeClosedCase($case, $caseObject)){
            return ;
        }

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
     * @throws \Exception
     */
    protected function getCaseFields(AbstractCase $caseObject, $case)
    {
        $data = [];

        foreach ($caseObject->questions() as $questionId => $question) {

            $value = array_get(array_get($case, 'properties'), $questionId);

            if(empty($value) && isset($question['alias'])){
                $value = array_get(array_get($case, 'properties'), $question['alias']);
            }

            if(isset($question['valueHandler'])){
                $value = app($question['valueHandler'])->handle($case, $questionId, $question, $caseObject);
            }

            $data[$question['column_name']] = $value;
        }

        $data['commcare_id'] = $case['id'];

        return $data;
    }

    /**
     * Remove closed case from our database
     *
     * @param $case
     * @param $caseObject
     * @return bool
     */
    protected function removeClosedCase($case, $caseObject)
    {
        if(array_get($case,'closed') === true){
            $caseObject->model()::where('commcare_id',$case['id'])->delete();

            return true;
        }

        return false;
    }
}