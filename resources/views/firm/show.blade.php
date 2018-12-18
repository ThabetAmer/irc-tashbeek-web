@extends('layouts.layout')
@section('content')
    <firm :firm="{{$firm->toJson()}}"></firm>
@endsection