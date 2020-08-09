@include('plugins.custom-loadTable')
@push('page-js')
    <script>
        let _tableUser;

        $(document).ready(function () {
            let $formStore = $('#form-manager-user'), $formEdit = $('#form-edit-user');

            _tableUser = loadTableUser();
            applyPhoneMask();
            $formStore.on('submit', function (e) {
                let $loadForm = $('#loader-store');
                e.preventDefault();
                $.ajax({
                    url: `{{ route('admin.user.store') }}`,
                    data: $formStore.serialize(),
                    type: 'post',
                    beforeSend: () => {
                        $formStore.find('input').prop('readonly', true);
                        $formStore.find('button').prop('disabled', true);
                        $loadForm.css('display', 'flex');
                    },
                    success: response => {
                        $formStore.find('input').prop('readonly', false);
                        $formStore.find('button').prop('disabled', false);
                        $loadForm.css('display', 'none');
                        $formStore.trigger('reset');
                        $('#modal-manager-user').modal('hide');
                        __toast.fire({icon: 'success', html: response.message});
                        _tableUser.loadTable('reload');
                    },
                    error: err => {
                        $formStore.find('input').prop('readonly', false);
                        $formStore.find('button').prop('disabled', false);
                        $loadForm.css('display', 'none');
                        let errors = err.responseJSON.errors, message = ' ';
                        if (errors) {
                            for (let er in errors) {
                                message = errors[er].join('<br>');
                            }
                        } else {
                            message = err.responseJSON.message;
                        }
                        __toast.fire({icon: 'error', title: ' ', html: message});
                    },
                });
            });

            $formEdit.on('submit', function (e) {
                e.preventDefault();
                let id = $formEdit.find('input[name="userID"]').val(), $loadForm = $('#loader-edit');
                $.ajax({
                    url: `/admin/user/update/${id}`,
                    data: $formEdit.serialize(),
                    type: 'PUT',
                    beforeSend: () => {
                        $formEdit.find('input').prop('readonly', true);
                        $formEdit.find('button').prop('disabled', true);
                        $loadForm.css('display', 'flex');
                    },
                    success: response => {
                        $formEdit.find('input').prop('readonly', false);
                        $formEdit.find('button').prop('disabled', false);
                        $loadForm.css('display', 'none');
                        $formEdit.trigger('reset');
                        $('#modal-edit-user').modal('hide');
                        __toast.fire({icon: 'success', html: response.message});
                        _tableUser.loadTable('reload');
                    },
                    error: err => {
                        $formEdit.find('input').prop('readonly', false);
                        $formEdit.find('button').prop('disabled', false);
                        $loadForm.css('display', 'none');
                        let errors = err.responseJSON.errors, message = ' ';
                        if (errors) {
                            for (let er in errors) {
                                message = errors[er].join('<br>');
                            }
                        } else {
                            message = err.responseJSON.message;
                        }
                        __toast.fire({icon: 'error', title: ' ', html: message});
                    },
                });
            });
        });

        function loadTableUser() {
            return $('.table-user').loadTable({
                url: `{{ route('admin.user.index') }}`,
                columns: [
                    {data: ['nome'], title: 'Usuário'},
                    {data: ['email'], title: 'Email'},
                    {
                        data: ['sysAdmin'], title: 'Permissão', render: (title, data, item) => {
                            let sysAdmin = data.shift();
                            return sysAdmin == true ? '<span class="badge badge-success">Administrador</span>'
                                : '<span class="badge badge-secondary">Comum</span>';
                        },
                    },
                    {
                        data: ['userID'], title: 'Opções', render: (title, data, item) => {
                            if (__authUser.sysAdmin) {
                                let userID = data.shift();
                                if (__authUser.userID == userID) return '';
                                return '<div class="table-data-feature">' +
                                    '<button onclick="updateUser(' + userID + ')" class="item" data-toggle="tooltip" data-placement="top" title="Alterar">' +
                                    '<i class="zmdi zmdi-edit text-warning"></i>' +
                                    '</button>' +
                                    '<button onclick="deleteUser(' + userID + ')" class="item" data-toggle="tooltip" data-placement="top" title="Remover">' +
                                    '<i class="zmdi zmdi-delete text-danger"></i>' +
                                    '</button>' +
                                    '</div>';
                            }
                            return '';
                        },
                    },
                ],
                afterInit: () => {
                    $('[data-toggle="tooltip"]').tooltip();
                },
            });
        }

        function applyPhoneMask() {
            let SPMaskBehavior = function (val) {
                    return val.replace(/\D/g, '').length === 9 ? '00000-0000' : '0000-00009';
                },
                spOptions = {
                    onKeyPress: function (val, e, field, options) {
                        field.mask(SPMaskBehavior.apply({}, arguments), options);
                    }
                };

            $('#user-phone').mask(SPMaskBehavior, spOptions);
            $('#edit-phone').mask(SPMaskBehavior, spOptions);
        }

        function updateUser(id) {
            let $form = $('#form-edit-user'), $loadForm = $('#loader-edit');
            $('#modal-edit-user').modal('show');
            $.ajax({
                url: `/admin/user/get/${id}`,
                type: 'get',
                beforeSend: () => {
                    $form.find('input').prop('readonly', true);
                    $form.find('button').prop('disabled', true);
                    $loadForm.css('display', 'flex');
                    $form.trigger('reset');
                },
                success: response => {
                    $form.find('input').prop('readonly', false);
                    $form.find('button').prop('disabled', false);
                    if (response != null) {
                        for (let k in response) {
                            if (k == 'sysAdmin') {
                                $form.find('#edit-admin').prop('checked', response[k]);
                            } else {
                                $form.find(`[name="${k}"]`).val(response[k]);
                            }
                        }
                    }
                    $loadForm.css('display', 'none');
                },
                error: err => {
                    $form.find('input').prop('readonly', false);
                    $form.find('button').prop('disabled', false);
                    $loadForm.css('display', 'none');
                    let errors = err.responseJSON.errors, message = ' ';
                    if (errors) {
                        for (let er in errors) {
                            message = errors[er].join('<br>');
                        }
                    } else {
                        message = err.responseJSON.message;
                    }
                    __toast.fire({icon: 'error', title: ' ', html: message});
                },
            });
        }

        function deleteUser(id) {
            Swal.fire({
                icon: 'warning',
                text: 'Tem certeza que deseja remover o usuário?',
                showCancelButton: true,
                confirmButtonText: 'Remover',
                showLoaderOnConfirm: true,
                cancelButtonText: 'Fechar',
                preConfirm: () => {
                    return fetch(`/admin/user/delete/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': `{{ csrf_token() }}`,
                        },
                    }).then(response => {
                        if (!response.ok) {
                            throw new Error(response.statusText)
                        }
                        return response.json()
                    }).catch(() => {
                        Swal.showValidationMessage('Ocorreu um erro ao remover o usuário!')
                    });
                },
                allowOutsideClick: () => !Swal.isLoading(),
            }).then((result) => {
                if (result.value) {
                    __toast.fire({icon: 'success', title: result.value.message || 'Removido!'});
                    _tableUser.loadTable('reload');
                }
            })
        }
    </script>
@endpush
