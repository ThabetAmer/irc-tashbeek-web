@extends('layouts.layout')
@section('content')
    <breadcrumbs
            :crumbs="[{name:'All employers', link:'firms'},{name:'{{$firm->firm_name}}', link:''}]"
    ></breadcrumbs>
    <firm :firm="{{$firm->toJson()}}"></firm>
@endsection