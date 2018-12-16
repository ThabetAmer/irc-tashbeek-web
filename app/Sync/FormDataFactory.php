<?php namespace App\Sync;

use App\Models\Form;
use App\Sync\Cases\Firm;
use App\Sync\Cases\Match;
use App\Sync\Cases\JobOpening;
use App\Sync\Cases\JobSeeker;
use Illuminate\Support\Facades\Storage;

class FormDataFactory
{
    use CaseVerification;

    protected $caseTypes = [
        Firm::class,
        JobSeeker::class,
        JobOpening::class,
        Match::class
    ];

    /**
     * @var string
     */
    protected $lastFetchDateFile = 'form_data_last_fetch.txt';

    /**
     * @var FormDataRequest
     */
    protected $request;

    /**
     * FormDataFactory constructor.
     * @param FormDataRequest $request
     */
    public function __construct(FormDataRequest $request)
    {
        $this->request = $request;
    }

    /**
     * Pull form data
     *
     * @param int $page
     */
    public function make($page = 1)
    {
        $params = ['page' => $page];
        if ($page === 1) {
            $params['received_on_start'] = $this->lastFetchDate();
        }

        $response = $this->request->data($params);

        $this->saveFormsData($response['objects']);

        if (!is_null($response['meta']['next'])) {
            $this->make($page + 1);
        }else{
            $this->saveLastFetchDate();
        }
    }

    /**
     * Save many form data
     *
     * @param $formData
     */
    protected function saveFormsData($formData)
    {
        foreach ($formData as $form) {
            $this->saveForm($form);
        }
    }

    /**
     * Save single form data
     *
     * @param $formData
     */
    protected function saveForm($formData)
    {
        $formId = $this->getFormIdFromXmlns($formData['form']['@xmlns']);

        $formId = strtolower($formId);

        $form = Form::where('commcare_id', $formId)->first();

        if (!$form) {
            return;
        }

        $case = $formData['form']['case'];

        $caseId = $case['@case_id'];
        $caseType = $case['create']['case_type'];

        $model = app($this->getClassFromType($caseType))->model()::where('commcare_id', $caseId)->first();

        if (!$model) {
            return;
        }

        if (!$model->forms()->where('form_id', $form->id)->first()) {
            $model->forms()->attach($form->id);
        }
    }

    /**
     * fetch the base form id from the form xml namespace
     *
     * @param $xmlns
     * @return mixed
     */
    protected function getFormIdFromXmlns($xmlns)
    {

        $segments = explode('/', parse_url($xmlns)['path']);

        return end($segments);
    }


    /**
     * @return null|string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function lastFetchDate()
    {
        $disk = Storage::disk('local');
        $lastFetchDate = null;
        if ($disk->exists($this->lastFetchDateFile)) {
            $lastFetchDate = $disk->get($this->lastFetchDateFile);
        }
        return $lastFetchDate;
    }

    /**
     * @param null $date
     */
    protected function saveLastFetchDate($date = null)
    {
        $disk = Storage::disk('local');
        $lastFetchDate = $date ?? \Carbon\Carbon::now()->format('Y-m-d');
        $disk->put($this->lastFetchDateFile, $lastFetchDate);
    }

}

