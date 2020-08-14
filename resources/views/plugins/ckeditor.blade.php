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
@endpush
