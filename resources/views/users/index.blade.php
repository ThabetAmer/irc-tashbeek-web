@extends('layouts.layout')
@section('content')
    <breadcrumbs
            :crumbs="[{name:'All users', link:'users'}]"
    ></breadcrumbs>
    <div class="" id="all-users">
        <users-listing></users-listing>
    </div>
@endsection