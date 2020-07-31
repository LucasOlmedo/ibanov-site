@extends('admin.auth.layout')
@section('page-title', 'Ibanov ADMIN - Login')
@section('content')
    <div class="login-wrap">
        <div class="login-content">
            <div class="login-logo">
                <img src="{{ asset('images/icon/logo.png') }}" alt="CoolAdmin">
            </div>
            <div class="login-form">
                <form action="" method="post">
                    @csrf
                    <div class="form-group">
                        <input aria-label="Email" type="email" name="email" placeholder="Email"
                               class="au-input au-input--full form-control {{ $errors->has('email') ? 'is-invalid' : '' }}">
                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <input aria-label="Senha" class="au-input au-input--full form-control" type="password"
                               name="password" placeholder="Senha">
                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="login-checkbox">
                        <div class="custom-control custom-checkbox mr-sm-2">
                            <input type="checkbox" class="custom-control-input" name="remember"
                                   id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="custom-control-label" for="remember">Lembrar-me</label>
                        </div>
                        <label>
                            <a href="{{ route('password.request') }}">Esqueceu sua senha?</a>
                        </label>
                    </div>
                    <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">Login</button>
                </form>
            </div>
        </div>
    </div>
@endsection
