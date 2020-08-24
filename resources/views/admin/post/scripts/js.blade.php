@include('plugins.custom-loadTable')
@push('page-js')
    <script>
        let _tablePost;

        $(document).ready(function () {
            _tablePost = loadTablePost();
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
                            let depId = data.shift();
                            if (__authUser.userID != item.userID) return '';
                            return '<div class="table-data-feature">' +
                                '<a href="/admin/post/edit/' + depId + '" class="item" data-toggle="tooltip" ' +
                                'data-placement="top" title="Alterar">' +
                                '<i class="zmdi zmdi-edit text-warning"></i>' +
                                '</a>' +
                                '<button onclick="deletePost(' + depId + ')" class="item" data-toggle="tooltip" ' +
                                'data-placement="top" title="Remover">' +
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

        function deletePost(id) {
            Swal.fire({
                icon: 'warning',
                text: 'Tem certeza que deseja remover o depoimento?',
                showCancelButton: true,
                confirmButtonText: 'Remover',
                showLoaderOnConfirm: true,
                cancelButtonText: 'Fechar',
                preConfirm: () => {
                    return fetch(`/admin/post/delete/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': `{{ csrf_token() }}`,
                        },
                    }).then(response => {
                        if (!response.ok) {
                            throw new Error(response.statusText);
                        }
                        return response.json();
                    }).catch(() => {
                        Swal.showValidationMessage('Ocorreu um erro ao remover o depoimento!');
                    });
                },
                allowOutsideClick: () => !Swal.isLoading(),
            }).then((result) => {
                if (result.value) {
                    __toast.fire({
                        icon: 'success',
                        title: `&nbsp;&nbsp;${result.value.message}` || `&nbsp;&nbsp;Removido!`
                    });
                    _tablePost.loadTable('reload');
                }
            });
        }
    </script>
@endpush
