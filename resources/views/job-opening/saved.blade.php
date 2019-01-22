@extends('layouts.layout')
@section('content')
    <div>
        <breadcrumbs
                :crumbs="[{name:'{{trans('irc.job_openings')}}', link:'{{route('job-openings')}}'},
                {name:'{{ trans('irc.job_opening_saved_match') }} [ {{$jobOpening->job_title}} ]', link:''}]"
        ></breadcrumbs>
        <job-opening-saved-matches
            route="{{route('api.matches.saved',[$jobOpening->id])}}"
            matches-url="{{route('job-openings.match',[$jobOpening->id])}}"
            :job-opening="{{$jobOpening}}"></job-opening-saved-matches>
    </div>
@endsection

