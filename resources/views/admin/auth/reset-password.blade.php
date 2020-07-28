@extends('admin.auth.layout')
@section('page-title', 'Ibanov ADMIN - Resetar sua senha')
@section('content')
    <div class="login-wrap">
        <div class="login-content">
            <div class="login-logo">
                <img src="{{ asset('images/icon/logo.png') }}" alt="CoolAdmin">
            </div>
            <div class="login-form">
                <form method="POST" action="{{ route('password.update') }}">
                    @method('post')
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-group">
                        <input aria-label="Email" type="email" name="email" readonly value="{{ $email }}"
                               class="au-input au-input--full form-control {{ $errors->has('email') ? ' is-invalid' : '' }}">
                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <input aria-label="Senha"
                               class="au-input au-input--full form-control  {{ $errors->has('password') ? ' is-invalid' : '' }}"
                               type="password" name="password" required placeholder="Digite a nova senha"
                               autocomplete="new-password">
                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <input aria-label="Senha" class="au-input au-input--full form-control" type="password"
                               name="password_confirmation" required placeholder="Confirme a nova senha"
                               autocomplete="new-password">
                    </div>
                    <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">Resetar Senha</button>
                </form>
            </div>
        </div>
    </div>
@endsection
