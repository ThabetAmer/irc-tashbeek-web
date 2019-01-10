<?php namespace App\Http\Controllers;


use App\Http\Requests\JobOpeningRequest;

class JobOpeningController extends Controller
{
    /**
     * Display a listing of all Job Seekers.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(JobOpeningRequest $request)
    {
        return view('job-opening.index');
    }
}
