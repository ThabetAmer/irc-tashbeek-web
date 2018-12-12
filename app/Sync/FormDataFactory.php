<?php namespace App\Sync;

use App\Models\Form;
use App\Sync\Cases\Firm;
use App\Sync\Cases\Match;
use App\Sync\Cases\JobOpening;
use App\Sync\Cases\JobSeeker;

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
        $response = $this->request->data(['page' => $page]);

        $this->saveFormsData($response['objects']);

        if (!is_null($response['meta']['next'])) {
            $this->make($page + 1);
        }
    }

    /**
     * Save many form data
     *
     * @param $formData
     */
    protected function saveFormsData($formData)
    {
        foreach($formData as $form){
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

        $form = Form::where('commcare_id',$formId)->first();

        if(!$form){
            return ;
        }

        $case = $formData['form']['case'];

        $caseId = $case['@case_id'];
        $caseType = $case['create']['case_type'];

        $model = app($this->getClassFromType($caseType))->model()::where('commcare_id',$caseId)->first();

        if(!$model){
            return ;
        }
        if(!$model->forms()->where('form_id',$form->id)->first()){
            $model->forms()->attach($form->id);
        }
    }

    /**
     * fetch the base form id from the form xml namespace
     *
     * @param $xmlns
     * @return mixed
     */
    protected function getFormIdFromXmlns($xmlns){

        $segments = explode('/',parse_url($xmlns)['path']);

        return end($segments);
    }
}

