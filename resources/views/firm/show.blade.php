@extends('layouts.layout')
@section('content')
    <breadcrumbs
            :crumbs="[{name:'{{ trans('irc.employers') }}', link:'{{route('firms')}}'},{name:'{{$firm->firm_name}}', link:''}]"
    ></breadcrumbs>
    <firm :firm="{{$firm->toJson()}}"></firm>
@endsection