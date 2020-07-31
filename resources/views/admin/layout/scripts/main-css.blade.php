<!-- Fontfaces CSS-->
<link href="{{ asset('css/font-face.css') }}" rel="stylesheet" media="all">
<link href="{{ asset('vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
<link href="{{ asset('vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">
<link href="{{ asset('vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet" media="all">

<!-- Bootstrap CSS-->
<link href="{{ asset('vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">

<!-- Vendor CSS-->
<link href="{{ asset('vendor/animsition/animsition.min.css') }}" rel="stylesheet" media="all">
<link href="{{ asset('vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet"
      media="all">
<link href="{{ asset('vendor/wow/animate.css') }}" rel="stylesheet" media="all">
<link href="{{ asset('vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet" media="all">
<link href="{{ asset('vendor/slick/slick.css') }}" rel="stylesheet" media="all">
<link href="{{ asset('vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
<link href="{{ asset('vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" media="all">

<!-- Main CSS-->
<link href="{{ asset('css/theme.css') }}" rel="stylesheet" media="all">

@push('page-css')
    <style>
        /**
            CUSTOM CSS
         */
        .row {
            margin-bottom: 20px;
        }

        .breadcrumb {
            font-size: .8em;
            padding-top: 0;
            padding-left: 0;
            background-color: transparent;
        }

        .breadcrumb-item.active {
            color: #4272d7;
        }

        .table-data-feature {
            justify-content: flex-start;
        }

        .table-earning tbody tr:hover td {
            cursor: initial !important;
        }

        .table-earning thead th {
            padding: 20px 35px;
        }

        .font-15 {
            font-size: 15px;
        }


        /* LOADER  FORM */

        .container-loader-form {
            background-color: #00000029;
            width: 100%;
            min-height: 100%;
            display: none;
            justify-content: center;
            align-items: center;

            /* position the div in center */
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1;
        }

        .loader-form {
            top: 40px;
            left: -2.5px;
        }

        .loader-form span {
            display: inline-block;
            width: 5px;
            height: 20px;
            background-color: #0dc7ff;
        }

        .loader-form span:nth-child(1) {
            animation: grow 1s ease-in-out infinite;
        }

        .loader-form span:nth-child(2) {
            animation: grow 1s ease-in-out 0.15s infinite;
        }

        .loader-form span:nth-child(3) {
            animation: grow 1s ease-in-out 0.30s infinite;
        }

        .loader-form span:nth-child(4) {
            animation: grow 1s ease-in-out 0.45s infinite;
        }

        @keyframes grow {
            0%, 100% {
                -webkit-transform: scaleY(1);
                -ms-transform: scaleY(1);
                -o-transform: scaleY(1);
                transform: scaleY(1);
            }

            50% {
                -webkit-transform: scaleY(1.8);
                -ms-transform: scaleY(1.8);
                -o-transform: scaleY(1.8);
                transform: scaleY(1.8);
            }
        }
    </style>
@endpush
