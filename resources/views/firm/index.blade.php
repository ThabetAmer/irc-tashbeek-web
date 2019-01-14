@extends('layouts.layout')
@section('content')
    <breadcrumbs
            :crumbs="[{name:'All employers', link:'firms'}]"
    ></breadcrumbs>
    <div class="" id="all-firms">
        <case-listing type="firm"></case-listing>
    </div>
@endsection

