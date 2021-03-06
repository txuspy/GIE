@extends('layouts.app')
@section('content')
<div class="portlet-body">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <form class="form" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}
                        <!--<div class="form-group{{ $errors->has('ldap') ? '  has-error' : '' }}">
                            <label for="ldap" class="col-md-4 control-label">{{ __('WebUntis') }}</label>
                            <div class="col-md-6">
                                <input id="ldap" type="text" class="form-control" name="ldap" value="{{ old('ldap') }}" required autofocus>
                                @if ($errors->has('ldap'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ldap') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>-->
                        <div class="form-group{{ $errors->has('email') ? '  has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">{{ __('Posta elektronikoa') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password') ? '  has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div> --}}

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                   {{ __("Entrar") }}
                                </button>

                                <a class="btn btn-link" href="{{ url('/password/reset') }}">
                                    {{ __("He olvidado mi contraseña") }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('sidebar')

@endsection