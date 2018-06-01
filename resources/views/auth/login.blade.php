@extends('layouts.master') 
@section('style')
<link rel="stylesheet" href="{{asset('css/login.css')}}">
@endsection
 
@section('content')
<div class="my-login-page">
    <div class="row justify-content-md-center h-100">
        <div class="card-wrapper">
            <div class="brand">
                <a href="{{route('home')}}">
                    <img src="{{URL::to('/')}}/images/logo.jpg">
                </a>
            </div>
            <div class="card fat">
                <div class="card-body">
                    <h4 class="card-title">Login</h4>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email">E-Mail Address</label>

                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}"
                                required autofocus> @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span> @endif
                        </div>

                        <div class="form-group">
                            <label for="password">Password
                                <a href="{{ route('password.request') }}" class="float-right">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </label>
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                                required> @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span> @endif
                        </div>

                        <div class="form-group">
                            <label>
                                <input type="checkbox" name="remember" {{ old( 'remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                            </label>
                        </div>

                        <div class="form-group no-margin">
                            <button type="submit" class="btn btn-primary btn-block">
                                {{ __('Login') }}
                            </button>
                        </div>
                        <div class="margin-top20 text-center">
                            Don't have an account?
                            <a href="{{route('register')}}">Create One</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="footer">
                Copyright &copy; 2018 &mdash; Flyzi
            </div>
        </div>
    </div>
</div>
@endsection