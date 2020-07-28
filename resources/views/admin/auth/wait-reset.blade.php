@extends('admin.auth.layout')
@section('page-title', 'Ibanov ADMIN - Esqueci minha senha')
@section('content')
    <div class="login-wrap">
        <div class="login-content">
            <div class="login-logo">
                <img src="{{ asset('images/icon/logo.png') }}" alt="CoolAdmin">
            </div>
            <div class="login-form">
                <div class="text-center">
                    <img src="{{asset('/images/mail_confirm.png')}}" alt="img" class="thumb-lg m-t-20 center-block">
                    <p class="text-muted font-13 m-t-20"> Um email foi enviado para <b>{{request()->get('email')}}</b>.
                        <br>
                        Siga as instruções para alterar sua senha. </p>
                    <br>
                    <a href="{{ route('login') }}" class="au-btn au-btn--block au-btn--green m-b-20">
                        Retornar ao início
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
