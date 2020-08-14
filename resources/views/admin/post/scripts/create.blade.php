@include('plugins.ckeditor')
@push('page-js')
    <script>
        $(document).ready(function () {
            ClassicEditor.create(document.querySelector('#post-text'), {
                removePlugins: [
                    'EasyImage', 'Image', 'ImageCaption',
                    'ImageStyle', 'ImageToolbar', 'ImageUpload', 'MediaEmbed',
                ],
                placeholder: 'Escreva aqui o seu depoimento...',
                language: 'pt-br',
            });
        });
    </script>
@endpush
