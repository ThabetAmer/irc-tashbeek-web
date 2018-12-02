<?php

namespace App\Http\Controllers\JobMatching;

use App\Configuration;
use App\Http\Controllers\Controller;
use App\Http\Requests\ConfigurationRequest;
use App\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Job $job
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Job $job
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Job $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Job $job)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Job $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        //
    }

    public function updateScores(Request $request, Job $job)
    {
        return response()->json(['message' => 'Scores updated successfully'], 200);
    }

    public function setConfig(ConfigurationRequest $request)
    {
        $webhookLink = $request->get('webhook_link', false);
        if ($webhookLink) {
            Configuration::query()->updateOrCreate([
                'key' => 'webhook_link'
            ], [
                'value' => $webhookLink
            ]);
        }

        return response()->json(['message' => 'Webhook link updated successfully'], 200);
    }

    public function getConfig(Request $request)
    {
        $webhook = Configuration::query()->where('key', 'webhook_link')->first();
        if ($webhook) {
            return [
                'key' => $webhook->key,
                'value' => $webhook->value,
            ];
        }
        return response()->json(['message' => 'Webhook link updated successfully'], 200);
    }


}
