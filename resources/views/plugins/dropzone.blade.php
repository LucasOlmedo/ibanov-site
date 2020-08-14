@push('page-css')
    <link rel="stylesheet" href="{{ asset('plugins/dropzone-5.7.0/dropzone.css') }}">
    <style>
        .dropzone {
            border: 2px dashed #007bff;
            border-radius: 7px;
        }
    </style>
@endpush
@push('page-js')
    <script src="{{ asset('plugins/dropzone-5.7.0/dropzone.js') }}"></script>
@endpush
