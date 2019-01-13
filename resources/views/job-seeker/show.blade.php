@extends('layouts.layout')
@section('content')
{{--    @dd($jobSeeker->first_name)--}}
    <breadcrumbs
            :crumbs="[{name:'All job seekers', link:'job-seekers'},{name:'{{$jobSeeker->displayName()}}', link:''}]"
    ></breadcrumbs>
    <job-seeker :job-seeker="{{$jobSeeker->toJson()}}"></job-seeker>
@endsection