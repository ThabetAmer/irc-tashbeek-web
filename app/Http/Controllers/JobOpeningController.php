<?php namespace App\Http\Controllers;


class JobOpeningController extends Controller
{
    /**
     * Display a listing of all Job Seekers.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('job-opening.index');
    }
}
