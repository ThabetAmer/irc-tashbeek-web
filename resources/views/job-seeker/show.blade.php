@extends('layouts.layout')
@section('content')
    <job-seeker :job-seeker="{{$jobSeeker->toJson()}}"></job-seeker>
@endsection