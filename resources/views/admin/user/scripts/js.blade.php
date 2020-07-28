@include('plugins.custom-loadTable')
@push('page-js')
    <script>
        $(document).ready(function () {
            const _tableUser = $('.table-user').loadTable({
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
                    {
                        data: ['userID'], title: 'Opções', render: (title, data, item) => {
                            return '<div class="table-data-feature">' +
                                '<button class="item" data-toggle="tooltip" data-placement="top" title="Alterar">' +
                                '<i class="zmdi zmdi-edit text-warning"></i>' +
                                '</button>' +
                                '<button class="item" data-toggle="tooltip" data-placement="top" title="Remover">' +
                                '<i class="zmdi zmdi-delete text-danger"></i>' +
                                '</button>' +
                                '</div>';
                        },
                    },
                ],
                afterInit: () => {
                    $('[data-toggle="tooltip"]').tooltip();
                },
            });
        });
    </script>
@endpush
