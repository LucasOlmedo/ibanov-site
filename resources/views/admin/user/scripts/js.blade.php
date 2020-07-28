@push('page-js')
    <script>
        $(document).ready(function () {
            $('.table-user').loadTable({
                url: `{{ route('admin.user.index') }}`,
                primaryKey: 'userID',
                columns: [
                    {data: ['nome'], title: 'Usuário'},
                    {data: ['email'], title: 'Email'},
                    {data: ['ddd', 'telefone'], title: 'Telefone'},
                    {data: [], title: 'Opções', actionType: ['edit', 'delete']},
                ],
            });
        });
    </script>
@endpush
