
@extends('layouts.layout')
@section('content')
    <breadcrumbs
            :crumbs="[{name:'All job seekers', link:'job-seekers'}]"
    ></breadcrumbs>

    <div class="" id="all-firms">
        <case-listing type="job-seeker"></case-listing>
    </div>
@endsection

