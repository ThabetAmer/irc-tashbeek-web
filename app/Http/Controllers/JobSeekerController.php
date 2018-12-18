<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\JobSeeker;
use Illuminate\Http\Request;

class JobSeekerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('job-seeker.index');
    }

    public function show(JobSeeker $jobSeeker)
    {
        return view('job-seeker.show',compact('jobSeeker'));
    }
}
