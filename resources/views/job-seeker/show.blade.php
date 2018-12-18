@extends('layouts.layout')
@section('content')
    <div class="" id="seekerProfile">
        <job-seeker :job-seeker="{{$jobSeeker->toJson()}}"></job-seeker>
    </div>
@endsection