@include('plugins.ckeditor')
@push('page-js')
    <script>
        $(document).ready(function () {
            ckeditor('#post-text');
        });
    </script>
@endpush
