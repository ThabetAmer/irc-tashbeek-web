<?php

namespace App\Http\Controllers;

use App\Export\CaseExport;
use App\Http\Controllers\Controller;
use App\Http\Filters\CaseFilter;
use App\Http\Requests\JobSeekerRequest;
use App\Http\Sortable\SortableCase;
use App\Models\JobSeeker;
use Illuminate\Http\Request;

class JobSeekerController extends Controller
{
    /**
     * Display a listing of all Job Seekers.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(JobSeekerRequest $request)
    {
        return view('job-seeker.index');
    }

    /**
     * Display Job Seeker details page.
     *
     * @param JobSeeker $jobSeeker
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(JobSeekerRequest $request, JobSeeker $jobSeeker)
    {
        return view('job-seeker.show', compact('jobSeeker'));
    }

    public function matches(JobSeeker $jobSeeker, CaseFilter $filter, SortableCase $sortableCase)
    {
        abort_unless(auth()->user()->hasPermissionTo("cases.match"), 403);

        $query = $jobSeeker->matches();

        $query->filter($filter);

        $query->sort($sortableCase);

        $results = $query->paginate();

        $caseType = 'job-opening';

        $collection = case_resource_collection($caseType, $results, $caseType);

        if (request('export')) {
            return export(CaseExport::class, $caseType . '_' . now()->format('Y:m:d'), $collection);
        }

        return $collection;
    }

    public function candidates(JobSeeker $jobSeeker, CaseFilter $filter, SortableCase $sortableCase)
    {
        abort_unless(auth()->user()->hasPermissionTo("cases.match"), 403);

        $query = $jobSeeker->matches();

        $query->filter($filter);

        $query->sort($sortableCase);

        $query->where('is_candidate',1);

        $results = $query->paginate();

        $caseType = 'job-opening';

        $collection = case_resource_collection($caseType, $results, $caseType);

        if (request('export')) {
            return export(CaseExport::class, $caseType . '_' . now()->format('Y:m:d'), $collection);
        }

        return $collection;
    }
}
