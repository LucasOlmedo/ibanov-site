@include('plugins.custom-loadTable')
@push('page-js')
    <script>
        let _tableUser;

        $(document).ready(function () {
            let $form = $('#form-manager-user'), $loadForm = $('.container-loader-form'),
                $modalStore = $('#modal-manager-user');

            _tableUser = loadTableUser();
            applyPhoneMask();
            $form.on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    url: `{{ route('admin.user.store') }}`,
                    data: $form.serialize(),
                    type: 'post',
                    beforeSend: () => {
                        $form.find('input').prop('readonly', true);
                        $form.find('button').prop('disabled', true);
                        $loadForm.css('display', 'flex');
                    },
                    success: response => {
                        $form.find('input').prop('readonly', false);
                        $form.find('button').prop('disabled', false);
                        $loadForm.css('display', 'none');
                        $form.trigger('reset');
                        $modalStore.modal('hide');
                        __toast.fire({icon: 'success', html: response.message});
                        _tableUser.loadTable('reload');
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
                    {data: ['ddd', 'telefone'], title: 'Telefone'},
                        @if(auth()->user()->isAdmin())
                    {
                        data: ['userID'], title: 'Opções', render: (title, data, item) => {
                            let userID = data.shift();
                            return '<div class="table-data-feature">' +
                                '<button onclick="updateUser(' + userID + ')" class="item" data-toggle="tooltip" data-placement="top" title="Alterar">' +
                                '<i class="zmdi zmdi-edit text-warning"></i>' +
                                '</button>' +
                                '<button onclick="deleteUser(' + userID + ')" class="item" data-toggle="tooltip" data-placement="top" title="Remover">' +
                                '<i class="zmdi zmdi-delete text-danger"></i>' +
                                '</button>' +
                                '</div>';
                        },
                    },
                    @endif
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
        }

        function updateUser(id) {
            console.log(id);
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
