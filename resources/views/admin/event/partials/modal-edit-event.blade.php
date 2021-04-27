@push('modal')
    <div class="modal fade" id="modal-edit-event" tabindex="-1" role="dialog" aria-labelledby="modal-edit-label"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-edit-label">Editar Evento</h5>
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
                    <form id="form-edit-event" method="post">
                        @csrf
                        <input type="hidden" name="agendaID">
                        <div class="form-group">
                            <label for="edit-name" class="control-label required mb-1">Título<span>*</span></label>
                            <input id="edit-name" name="Titulo" type="text" class="form-control" required
                                   placeholder="Ex: Evento X">
                        </div>
                        <div class="form-group">
                            <label for="start-event" class="control-label required mb-1">Início<span>*</span></label>
                            <input type="datetime-local" id="start-event" name="StartDate" class="form-control"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="end-event" class="control-label required mb-1">Fim<span>*</span></label>
                            <input type="datetime-local" id="end-event" name="EndDate" class="form-control"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="edit-desc" class="control-label mb-1">Descrição *</label>
                            <textarea name="Texto" id="edit-desc" rows="4" class="form-control">Exemplo</textarea>
                        </div>
                        <div class="form-group m-t-15 mb-0 float-right">
                            <button type="button" class="btn btn-secondary m-r-10" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-info btn-submit-edit-event">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endpush
