<!-- Jquery JS-->
<script src="{{ asset('vendor/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('vendor/jquery-ui.min.js') }}"></script>

<!-- Bootstrap JS-->
<script src="{{ asset('vendor/bootstrap-4.1/popper.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>

<!-- Vendor JS       -->
<script src="{{ asset('vendor/slick/slick.min.js') }}"></script>
<script src="{{ asset('vendor/wow/wow.min.js') }}"></script>
<script src="{{ asset('vendor/animsition/animsition.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
<script src="{{ asset('vendor/counter-up/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('vendor/counter-up/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('vendor/circle-progress/circle-progress.min.js') }}"></script>
<script src="{{ asset('vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('vendor/chartjs/Chart.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
<script src="{{ asset('vendor/jquery-mask/jquery.mask.min.js') }}"></script>
<script src="{{ asset('vendor/moment/moment.min.js') }}"></script>

<!-- Lib JS-->
<script src="{{ asset('lib/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>

<!-- Main JS-->
<script src="{{ asset('js/main_admin.js') }}"></script>

@push('page-js')
    <script>
        /**
         * Custom JS
         */
        const __authUser = JSON.parse(`@json(auth()->user())`);

        $(document).on('change', function () {
            $('[data-toggle="tooltip"]').tooltip();
        });

        function uniqId() {
            return Math.random().toString(10).substr(2, 9);
        }
    </script>
@endpush
