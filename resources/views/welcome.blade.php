@extends('master.master')
@section('content')
    <div class="" id="builder">
        <builder></builder>
    </div>
@endsection



<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
{{--<script src="{{ asset('js/app.js') }}" type="text/javascript"></script>--}}

@section('script')
    <script src="{{ asset('js/builder.js') }}" type="text/javascript"></script>

@endsection