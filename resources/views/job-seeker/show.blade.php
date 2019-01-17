@extends('layouts.layout')
@section('content')
{{--    @dd($jobSeeker->first_name)--}}
    <breadcrumbs
            :crumbs="[{name:'{{trans('irc.all_job_seekers')}}', link:'{{route('job-seekers')}}'},{name:'{{$jobSeeker->displayName()}}', link:''}]"
    ></breadcrumbs>
    <job-seeker :job-seeker="{{ json_encode(case_resource('job-seeker',$jobSeeker)->toArray(request())) }}"></job-seeker>
@endsection