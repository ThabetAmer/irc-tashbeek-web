@extends('layouts.layout')
@section('content')
    <breadcrumbs
            :crumbs="[{name:'{{trans('irc.users')}}', link:'{{route('users')}}'}]"
    ></breadcrumbs>
    <div>
        <users-listing></users-listing>
    </div>
@endsection