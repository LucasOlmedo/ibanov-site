@push('page-css')
    <link rel="stylesheet" href="{{ asset('plugins/fullcalendar-5.3.2/main.min.css') }}">
    <style>
        .fc > div.fc-header-toolbar.fc-toolbar.fc-toolbar-ltr > div:nth-child(2) > h2 {
            text-transform: capitalize;
        }

        .fc-view-harness.fc-view-harness-active {
            background: white;
        }

        .fc .fc-daygrid-day.fc-day-today {
            background-color: rgba(0, 123, 255, 0.25);
        }

        .fc .fc-timegrid-col.fc-day-today {
            background-color: rgba(0, 123, 255, 0.25);
        }

        .fc .fc-highlight {
            background-color: rgba(235, 255, 144, 0.45) !important;
        }
    </style>
@endpush
@push('page-js')
    <script src="{{ asset('plugins/fullcalendar-5.3.2/main.min.js') }}"></script>
    <script src="{{ asset('plugins/fullcalendar-5.3.2/locales/pt-br.js') }}"></script>
@endpush
