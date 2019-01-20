<?php

namespace App\Http\Controllers;

use App\Http\Filters\CaseFilter;
use App\Http\Sortable\SortableCase;
use App\Models\JobOpening;
use App\Models\Match;

class JobOpeningMatchController extends Controller
{

    public function index(JobOpening $jobOpening)
    {
        abort_unless(auth()->user()->hasPermissionTo("cases.match"), 403);

        return view('job-opening.match', compact('jobOpening'));
    }

    public function matches(JobOpening $jobOpening, CaseFilter $filter, SortableCase $sortableCase)
    {
        abort_unless(auth()->user()->hasPermissionTo("cases.match"), 403);

        $caseType = 'job-seeker';

        $query = get_case_type_model($caseType)->query();

        $query->filter($filter);

        $query->sort($sortableCase);

        $results = $query->paginate(50);

        $collection = case_resource_collection($caseType, $results, $caseType);


        $collection->additional([
            'matches' => $jobOpening->matchesFromPivot()->pluck('job_seeker_id')
        ]);

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

        Match::where('job_opening_id',$jobOpening->id)->whereNotIn('job_seeker_id',$matches)->update([
            'is_candidate' => 0
        ]);

        Match::where('job_opening_id',$jobOpening->id)->whereIn('job_seeker_id',$matches)->update([
            'is_candidate' => 1
        ]);
    }
}
