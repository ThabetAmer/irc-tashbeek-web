<?php

namespace App\Http\Controllers;

use App\Http\Requests\FirmRequest;
use App\Models\Firm;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FirmController extends Controller
{
    /**
     * Display a listing of all Job Seekers.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FirmRequest $request)
    {
        return view('firm.index');
    }

    /**
     * Display Job Seeker details page.
     *
     * @param Firm $firm
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(FirmRequest $request, Firm $firm)
    {
        return view('firm.show', compact('firm'));
    }
}
