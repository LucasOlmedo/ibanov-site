@include('plugins.ckeditor')
@push('page-js')
    <script>
        $(document).ready(function () {
            ckeditor('#post-text');
            $('.image-upload-wrap').hide();
            $('.file-upload-content').show();
        });
    </script>
@endpush
