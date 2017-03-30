@extends('layouts.login')

@section('content')
<div class="auth-container">
  <div class="card">
    <header class="auth-header">
      <h1 class="auth-title">
        <div class="logo"> <span class="l l1"></span> <span class="l l2"></span> <span class="l l3"></span> <span class="l l4"></span> <span class="l l5"></span> </div> ModularAdmin
      </h1>
    </header>
      <div class="auth-content">

        <p class="text-xs-center">LOGIN TO CONTINUE</p>
        <form id="login-form" role="form" method="POST" action="{{ url('/login') }}">
          {{ csrf_field() }}

          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email">E-Mail Address</label>
            <div>
              <input id="email" type="email" class="form-control underlined" name="email" value="{{ old('email') }}" placeholder="email" required autofocus>
              @if ($errors->has('email'))
              <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
              </span>
              @endif
            </div>
          </div>

          <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password">Password</label>
            <div>
              <input id="password" type="password" class="form-control underlined" name="password" required>
              @if ($errors->has('password'))
              <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
              </span>
              @endif
            </div>
          </div>

          <div class="form-group">
            <label for="remember">
              <input type="checkbox" name="remember" class="checkbox">
              <span>Remember me</span>
            </label>
            <a href="{{ url('/password/reset') }}" class="forgot-btn pull-right">
              Forgot Your Password?
            </a>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-block btn-primary">Login</button>
          </div>

        </form>

      </div>
  </div>
</div>
@endsection
