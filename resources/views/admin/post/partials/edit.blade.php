@extends('admin.layout.master')
@include('admin.post.scripts.edit')
@include('admin.layout.components.img-uploader', ['img' => $post->imagem])
@section('page-title', 'Editar Depoimento')
@section('breadcrumb')
    <li class="breadcrumb-item">
        Admin
    </li>
    <li class="breadcrumb-item">
        Depoimentos
    </li>
    <li class="breadcrumb-item active">
        Editar
    </li>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <a href="{{ route('admin.post.index') }}" class="btn btn-secondary">
                <i class="zmdi zmdi-arrow-left"></i> Voltar
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Editar Depoimento</div>
                <div class="card-body">
                    <form action="{{ route('admin.post.update', ['id' => $post->depoimentoID]) }}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="post-title" class="control-label required mb-1">Título <span>*</span></label>
                            <input id="post-title" name="titulo" type="text" class="form-control" required
                                   placeholder="Ex: Título 1" value="{{ $post->titulo }}">
                        </div>
                        <div class="form-group">
                            <label for="post-image" class="control-label required mb-1">Imagem <span>*</span></label>
                            @stack('img-uploader-component')
                        </div>
                        <div class="form-group">
                            <label for="post-text" class="control-label required mb-1">Texto <span>*</span></label>
                            <textarea id="post-text" name="Texto">{{{ $post->Texto }}}</textarea>
                        </div>
                        <div class="m-t-15">
                            <button id="save-button" type="submit" class="btn btn-lg btn-info btn-block">
                                <i class="zmdi zmdi-hc-1x zmdi-edit"></i>&nbsp;&nbsp;Atualizar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
