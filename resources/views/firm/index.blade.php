@extends('layouts.layout')
@section('content')
    <breadcrumbs
            :crumbs="[{name:'{{trans('irc.employers')}}', link:'{{route('firms')}}'}]"
    ></breadcrumbs>
    <div>
        <case-listing type="firm"></case-listing>
    </div>
@endsection

