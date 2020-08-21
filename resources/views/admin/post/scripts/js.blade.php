@include('plugins.custom-loadTable')
@push('page-js')
    <script>
        let _tableUser;

        $(document).ready(function () {
            _tableUser = loadTablePost();
        });

        function loadTablePost() {
            return $('.table-post').loadTable({
                url: `{{ route('admin.post.index') }}`,
                columns: [
                    {
                        data: ['userID'], title: 'Usuário', render: (title, data, item) => {
                            return item.user.nome;
                        }
                    },
                    {data: ['titulo'], title: 'Título'},
                    {
                        data: ['DateIns'], title: 'Publicação', render: (title, data) => {
                            let date = data.shift();
                            return moment(date).format('DD/MM/YYYY HH:mm:ss');
                        }
                    },
                    {
                        data: ['depoimentoID'], title: 'Opções', render: (title, data, item) => {
                            if (__authUser.userID != item.userID) return '';
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
        }
    </script>
@endpush
