@extends('layouts.auth')

@section('CoreContent')
    <!-- Login Container -->
<div id="login-container" class="animation-fadeIn">
        <!-- Login Title -->
        <div class="login-title text-center">
    
            <h1>
                {{-- <img src="{{asset('Template/img/icon180.png')}}" style="width:50;height:50;" alt="Logo"> --}}
                <span class="sidebar-nav-mini-hide"><strong>@lang('messages.Pname')</strong></span>
                <br><small>Please <strong>Login</strong> </small>
            </h1>
        </div>
        <!-- Login Block -->
        <div class="block push-bit">
            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}" id="form-login" class="form-horizontal form-bordered form-control-borderless">
                @csrf
    
                <div class="form-group row">
                    <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
    
                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}"
                            required autofocus> @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span> @endif
                    </div>
                </div>
    
    
    
                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
    
                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                            required> @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span> @endif
                    </div>
                </div>
    
                <div class="form-group row">
                    <div class="col-md-6 offset-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old( 'remember') ? 'checked' : '' }}>
    
                            <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                        </div>
                    </div>
                </div>
    
                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
    
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                    </div>
                </div>
            </form>
            <!-- END Login Form -->
    
    
        </div>
        <!-- END Login Block -->
    </div>
    <!-- END Login Container -->
@endsection


@section('ScriptContent')
    
    <!-- Load and execute javascript code used only in this page -->
    <script src="{{url('/')}}/OldTemplate/js/login.js"></script>
    <script>
        $(function(){ Login.init(); });
    </script>

@endsection
