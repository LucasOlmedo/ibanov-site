@extends('admin.layout.master')
@include('admin.user.scripts.css')
@include('admin.user.scripts.js')
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
    <div class="row">
        <div class="col-12">
            <button class="au-btn au-btn-icon au-btn--blue au-btn--small" data-toggle="modal"
                    data-target="#modal-manager-user">
                <i class="zmdi zmdi-plus"></i> Novo usuário
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <table class="table table-user"></table>
        </div>
    </div>
@endsection
@section('modal')
    <div class="modal fade" id="modal-manager-user" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="largeModalLabel">Novo usuário</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab animi aperiam, commodi, cupiditate
                    dolorum earum error esse, fugit hic modi omnis perspiciatis porro quae similique sint vel veritatis
                    voluptatum. Eum!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary">Salvar</button>
                </div>
            </div>
        </div>
    </div>
@endsection
