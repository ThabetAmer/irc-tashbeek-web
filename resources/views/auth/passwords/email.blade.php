@extends('layouts.layout')

@section('content')

    <div class="w-full max-w-24 mx-auto">
        <div class="image-top">
            <div class=" p-4 rounded-t text-center " style="background: rgba(64, 94, 128, 1);">
                <img style="height: 140px;" class="mx-auto" src="{{ asset('img/logo_big.png') }}" alt="">
            </div>
        </div>
        <form method="POST" action="{{ route('login') }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            <div class="text-grey-darkest font-bold text-base mb-3">Send reset link </div>
            <div class="mb-4">
                <label class="block text-grey-darker text-sm font-bold mb-2" for="username">
                    Email
                </label>
                <input id="email" type="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                @endif
            </div>
            <div class="flex items-center justify-between mt-6">
                <button type="submit"
                        class="bg-blue hover:bg-blue-dark text-white font-bold text-xs py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    {{ __('Send Password Reset Link') }}
                </button>


            </div>
            <div class="pt-3 text-xs text-left">
                <a class="dec inline-block no-underline align-baseline font-bold text-sm text-blue hover:text-blue-darker"
                   href="{{ route('login') }}">
                    {{ __('Back to login') }}
                </a>
            </div>

        </form>
    </div>

@endsection
