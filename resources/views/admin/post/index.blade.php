@extends('admin.layout.master')
@include('admin.post.scripts.css')
@include('admin.post.scripts.js')

@section('page-title', 'Gestão de Depoimentos')
@section('breadcrumb')
    <li class="breadcrumb-item">
        Admin
    </li>
    <li class="breadcrumb-item active">
        Depoimentos
    </li>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <a href="{{ route('admin.post.create') }}" class="btn btn-primary">
                <i class="zmdi zmdi-plus"></i> Novo depoimento
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <table class="table table-post"></table>
        </div>
    </div>
@endsection
