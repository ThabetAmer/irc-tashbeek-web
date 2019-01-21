@extends('layouts.layout')
@section('content')
    <div>
        <job-opening-saved-matches
            route="{{route('api.matches.saved',[$jobOpening->id])}}"
            matches-url="{{route('job-openings.match',[$jobOpening->id])}}"
            :job-opening="{{$jobOpening}}"></job-opening-saved-matches>
    </div>
@endsection

