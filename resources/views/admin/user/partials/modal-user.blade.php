@section('modal')
    <div class="modal fade" id="modal-manager-user" tabindex="-1" role="dialog" aria-labelledby="modal-title-label"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title-label">Novo usuário</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-loader-form">
                        <div class="loader-form">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                    <form id="form-manager-user" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="user-name" class="control-label mb-1">Nome</label>
                            <input id="user-name" name="nome" type="text" class="form-control" required
                                   placeholder="Ex: John Doe">
                        </div>
                        <div class="form-group">
                            <label for="user-email" class="control-label mb-1">Email</label>
                            <input id="user-email" name="email" type="email" class="form-control" required
                                   placeholder="Ex: john@example.com">
                        </div>
                        <div class="form-group">
                            <label for="user-address" class="control-label mb-1">Endereço</label>
                            <input id="user-address" name="endereco" type="text" class="form-control"
                                   placeholder="Ex: Rua Abcd, 123 - SP">
                        </div>
                        <div class="row mb-0">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="user-ddd" class="control-label mb-1">DDD</label>
                                    <input id="user-ddd" name="ddd" type="text" class="form-control"
                                           placeholder="Ex: (11)" data-mask="(00)">
                                </div>
                            </div>
                            <div class="col-8">
                                <label for="user-phone" class="control-label mb-1">Telefone</label>
                                <div class="input-group">
                                    <input id="user-phone" name="telefone" type="tel" class="form-control"
                                           placeholder="Ex: 98765-4321">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <input type="checkbox" class="custom-control-input" id="user-admin" name="sysAdmin">
                                <label class="custom-control-label" for="user-admin">Administrador</label>
                            </div>
                        </div>
                        <div class="alert alert-warning fade show mb-0">
                            <span class="badge badge-pill badge-warning">Importante!</span>
                            A senha padrão para os novos usuários é
                            <ins><strong>#ibanov.1234</strong></ins>
                        </div>
                        <div class="form-group m-t-15 mb-0 float-right">
                            <button type="button" class="btn btn-secondary m-r-10" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-info btn-submit-form-user">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
