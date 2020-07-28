@extends('admin.auth.layout')
@section('page-title', 'Ibanov ADMIN - Esqueci minha senha')
@section('content')
    <div class="login-wrap">
        <div class="login-content">
            <div class="login-logo">
                <img src="{{ asset('images/icon/logo.png') }}" alt="CoolAdmin">
            </div>
            <div class="login-form">
                <form action="{{ route('password.email') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <input aria-label="Email"
                               class="au-input au-input--full form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                               type="email" name="email" placeholder="Digite seu email">
                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">Enviar</button>
                </form>
            </div>
        </div>
    </div>
@endsection
