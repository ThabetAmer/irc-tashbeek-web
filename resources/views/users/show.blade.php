@extends('layouts.layout')
@section('content')
    <breadcrumbs
            :crumbs="[{name:'All users', link:'/users'},{name:'Viewing [{{$user->name}}]', link:''}]"
    ></breadcrumbs>
    <div class="" id="all-users">
        <user-view
                :user-prop="{{$user->toJson()}}"
                :roles="{{$roles->toJson()}}"
                :view-only="true"
        ></user-view>
    </div>
@endsection



{{--<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>--}}
{{--<script src="{{ asset('js/app.js') }}" type="text/javascript"></script>--}}

@section('script')
@endsection
