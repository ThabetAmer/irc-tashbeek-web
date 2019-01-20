@extends('layouts.layout')

@section('content')

    <div class="w-full max-w-24 mx-auto">
        <div class="image-top">
            <div class=" p-4 rounded-t text-center " style="background: rgba(64, 94, 128, 1);">
                <img style="height: 140px;" src="{{ asset('img/logo_big.png') }}" alt="">
            </div>
        </div>
        <form method="POST" action="{{ route('password.update') }}"
              class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            <div class="mb-4">
                <label class="block text-grey-darker text-sm font-bold mb-2" for="username">
                    Email
                </label>
                <input id="email" type="email"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                       name="email" value="{{ $email ?? old('email') }}" required autofocus>

                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                @endif
            </div>
            <div class="mb-4">
                <label class="block text-grey-darker text-sm font-bold mb-2" for="password">
                    Password
                </label>
                <input id="password" type="password"
                       class="shadow appearance-none border  rounded w-full py-2 px-3 text-grey-darker mb-3 leading-tight focus:outline-none focus:shadow-outline form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                       name="password" required>

                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                @endif


                @if ($errors->has('deactivated_user'))
                    <span class="text-red-dark"><strong>{{$errors->first('deactivated_user')}}</strong></span>
                @endif
            </div>

            <div class="mb-6">


                <label for="password-confirm"
                       class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                <input id="password-confirm" type="password"
                       class="shadow appearance-none border  rounded w-full py-2 px-3 text-grey-darker mb-3 leading-tight focus:outline-none focus:shadow-outline form-control form-control"
                       name="password_confirmation" required>

            </div>


            <div class="flex items-center justify-between">
                <button type="submit"
                        class="bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    {{ __('Reset Password') }}
                </button>

            </div>
        </form>
    </div>
@endsection
