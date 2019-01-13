@extends('layouts.layout')
@section('content')
    <div>
        <job-opening-match route="{{route('api.matches',[$jobOpening->id])}}" :job-opening="{{$jobOpening}}"></job-opening-match>
    </div>
@endsection

