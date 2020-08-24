@push('page-css')
    <style>
        .ck.ck-editor__editable {
            min-height: 250px;
        }

        .ck-sticky-panel__content_sticky {
            top: 75px !important;
        }

        .ck.ck-editor__main > div,
        .ck.ck-editor__main > div > ul,
        .ck.ck-editor__main > div > ol {
            padding: 0 30px 0;
        }
    </style>
@endpush
@push('page-js')
    <script src="{{ asset('plugins/ckeditor5/ckeditor.js') }}"></script>
    <script src="{{ asset('plugins/ckeditor5/lang/pt-br.js') }}"></script>
    <script>
        function ckeditor(selector) {
            ClassicEditor.create(document.querySelector(selector), {
                placeholder: 'Escreva aqui o seu depoimento...',
                removePlugins: [
                    'EasyImage', 'Image', 'ImageCaption', 'Title',
                    'ImageStyle', 'ImageToolbar', 'ImageUpload', 'MediaEmbed',
                ],
                toolbar: {
                    items: [
                        'exportPdf', '|', 'heading', '|',
                        'bold', 'italic', 'underline', 'link', 'bulletedList', 'numberedList', '|',
                        'fontFamily', 'fontColor', 'fontBackgroundColor', 'fontSize', '|',
                        'indent', 'outdent', 'alignment', '|', 'blockQuote', 'insertTable', 'undo', 'redo', '|',
                    ],
                },
                language: 'pt-br',
            });
        }
    </script>
@endpush
