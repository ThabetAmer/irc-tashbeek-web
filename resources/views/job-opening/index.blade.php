@extends('layouts.layout')
@section('content')
    <breadcrumbs
            :crumbs="[{name:'All job openings', link:'job-openings'}]"
    ></breadcrumbs>
    <div class="" id="all-firms">
        <case-listing type="job-opening"></case-listing>
    </div>
@endsection

