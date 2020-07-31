@extends('admin.layout.master')
@include('admin.user.scripts.css')
@include('admin.user.scripts.js')
@include('admin.user.partials.modal-user')
@section('page-title', 'Gestão de usuários')
@section('breadcrumb')
    <li class="breadcrumb-item">
        Admin
    </li>
    <li class="breadcrumb-item active">
        Usuários
    </li>
@endsection
@section('content')
    @if(auth()->user()->isAdmin())
        <div class="row">
            <div class="col-12">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modal-manager-user">
                    <i class="zmdi zmdi-plus"></i> Novo usuário
                </button>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <table class="table table-user"></table>
        </div>
    </div>
@endsection
