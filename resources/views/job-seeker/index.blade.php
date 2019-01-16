
@extends('layouts.layout')
@section('content')
    <breadcrumbs
            :crumbs="[{name:'{{trans('irc.all_job_seekers')}}', link:'{{route('job-seekers')}}'}]"
    ></breadcrumbs>

    <div class="" id="all-firms">
        <case-listing type="job-seeker"></case-listing>
    </div>
@endsection

