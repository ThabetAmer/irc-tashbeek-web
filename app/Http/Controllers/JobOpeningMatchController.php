<?php

namespace App\Http\Controllers;

use App\Export\CaseExport;
use App\Http\Filters\CaseFilter;
use App\Http\Sortable\SortableCase;
use App\Models\JobOpening;
use App\Models\Match;

class JobOpeningMatchController extends Controller
{

    public function index(JobOpening $jobOpening)
    {
        abort_unless(auth()->user()->hasPermissionTo("cases.match"), 403);

        $jobOpening->load('firm');

        return view('job-opening.match', compact('jobOpening'));
    }

    public function matches(JobOpening $jobOpening, CaseFilter $filter, SortableCase $sortableCase)
    {
        abort_unless(auth()->user()->hasPermissionTo("cases.match"), 403);

        $caseType = 'job-seeker';

        $query = get_case_type_model($caseType)->query();

        $query->filter($filter);

        $query->sort($sortableCase);

        $query->withCandidateInJobOpening($jobOpening->id);

        $results = $query->paginate(50);

        $collection = case_resource_collection($caseType, $results, $caseType);

        $collection->additional([
            'matches' => $jobOpening->matchesFromPivot()->pluck('job_seeker_id')
        ]);

        return $collection;
    }


    public function saved(JobOpening $jobOpening)
    {
        abort_unless(auth()->user()->hasPermissionTo("cases.match"), 403);

        if(request()->wantsJson()){
            return $this->savedMatches($jobOpening, request());
        }

        return view('job-opening.saved', compact('jobOpening'));
    }


    public function savedList(JobOpening $jobOpening, CaseFilter $filter, SortableCase $sortableCase)
    {
        abort_unless(auth()->user()->hasPermissionTo("cases.match"), 403);

        $caseType = 'job-seeker';

        $query = $jobOpening->matches();

        $query->filter($filter);

        $query->sort($sortableCase);

        $results = $query->paginate(50);

        $collection = case_resource_collection($caseType, $results, $caseType);

        if (request('export')) {
            return export(CaseExport::class, $caseType . '_' . now()->format('Y:m:d'), $collection);
        }


        return $collection;
    }


    public function store(JobOpening $jobOpening)
    {
        abort_unless(auth()->user()->hasPermissionTo("cases.match.save"), 403);

        request()->validate([
            'matches' => 'present|array',
            'matches.*' => 'numeric'
        ]);

        $matches = request('matches');

        Match::where('job_opening_id', $jobOpening->id)->whereNotIn('job_seeker_id', $matches)->delete();


        foreach($matches as $match){
            $data = [
                'job_seeker_id' => $match
            ];

            $attributes = [
                'job_seeker_id' => $match,
                'job_opening_id' => $jobOpening->id
            ];

            Match::updateOrCreate($attributes, $data);
        }
    }

}
