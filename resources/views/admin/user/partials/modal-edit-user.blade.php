@push('modal')
    <div class="modal fade" id="modal-edit-user" tabindex="-1" role="dialog" aria-labelledby="modal-edit-label"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-edit-label">Editar usuário</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-loader-form" id="loader-edit">
                        <div class="loader-form">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                    <form id="form-edit-user" method="post">
                        @csrf
                        <input type="hidden" name="userID">
                        <div class="form-group">
                            <label for="edit-name" class="control-label mb-1">Nome</label>
                            <input id="edit-name" name="nome" type="text" class="form-control" required
                                   placeholder="Ex: John Doe">
                        </div>
                        <div class="form-group">
                            <label for="edit-email" class="control-label mb-1">Email</label>
                            <input id="edit-email" name="email" type="email" class="form-control" required
                                   placeholder="Ex: john@example.com" disabled>
                        </div>
                        <div class="form-group">
                            <label for="edit-address" class="control-label mb-1">Endereço</label>
                            <input id="edit-address" name="endereco" type="text" class="form-control"
                                   placeholder="Ex: Rua Abcd, 123 - SP">
                        </div>
                        <div class="row mb-0">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="edit-ddd" class="control-label mb-1">DDD</label>
                                    <input id="edit-ddd" name="ddd" type="text" class="form-control"
                                           placeholder="Ex: (11)" data-mask="(00)">
                                </div>
                            </div>
                            <div class="col-8">
                                <label for="edit-phone" class="control-label mb-1">Telefone</label>
                                <div class="input-group">
                                    <input id="edit-phone" name="telefone" type="tel" class="form-control"
                                           placeholder="Ex: 98765-4321">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <input type="checkbox" class="custom-control-input" id="edit-admin" name="sysAdmin">
                                <label class="custom-control-label" for="edit-admin">Administrador</label>
                            </div>
                        </div>
                        <div class="form-group m-t-15 mb-0 float-right">
                            <button type="button" class="btn btn-secondary m-r-10" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-info btn-submit-edit-user">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endpush
