<?php

namespace App\Http\Controllers;

use App\Http\Filters\MatchesFilter;
use App\Http\Sortable\SortableCase;
use App\Models\JobOpening;

class JobOpeningMatchController extends Controller
{

    public function index(JobOpening $jobOpening)
    {
        return view('job-opening.match', compact('jobOpening'));
    }

    public function matches(JobOpening $jobOpening, MatchesFilter $filter, SortableCase $sortableCase)
    {
        abort_unless(auth()->user()->hasPermissionTo("cases.match"), 403);

        $query = $jobOpening->matches();

        $query->filter($filter);

        $query->sort($sortableCase);

        $results = $query->paginate(200);

        $caseType = 'job-seeker';

        return case_resource_collection($caseType, $results, $caseType);
    }
}
