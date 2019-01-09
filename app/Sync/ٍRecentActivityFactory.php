<?php namespace App\Sync;

use App\Models\User;
use App\Sync\Cases\AbstractCase;
use App\Sync\Cases\Firm;
use App\Sync\Cases\Match;
use App\Sync\Cases\JobOpening;
use App\Sync\Cases\JobSeeker;
use App\Sync\QuestionHandler\DateHandler;

class RecentActivityFactory
{
    /**
     * @var StructureRequest
     */
    protected $request;

    /**
     * StructureFactory constructor.
     * @param FormRequest $request
     */
    public function __construct(FormRequest $request)
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
    public function make($caseType, $xmlns, $page = 1)
    {
        $response = $this->request->data([
            'page' => $page,
            'xmlns' => 'http://openrosa.org/formdesigner/' . $xmlns
        ]);

        $this->saveItems($caseType, $response['objects']);

        if (!is_null($response['meta']['next'])) {
            $this->make($caseType,$xmlns, $page + 1);
        }
    }

    /**
     * Save multiple cases data
     *
     * @param $cases
     * @throws \Exception
     */
    protected function saveItems($caseType, $cases)
    {
        foreach ($cases as $case) {
            $this->saveItem($caseType, $case);
        }
    }

    /**
     * Save single case data
     *
     * @param $caseType
     * @param $form
     */
    protected function saveItem($caseType, $form)
    {
        $model = get_case_type_model($caseType);

        $commCareId = array_get($form,'form.case.@case_id');

        $query = $model->query()->where('commcare_id', $commCareId);

        $record = $query->first();

        if(!$record){
            return;
        }

        if($record->recentActivities()->where('commcare_id',$form['id'])->first()){
            return ;
        }

        $record->recentActivities()->create([
            'commcare_id' => $form['id'],
            'title' => array_get($form,'form.@name'),
            'created_at' => app(DateHandler::class)->resolve($form['received_on'])
        ]);

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
}