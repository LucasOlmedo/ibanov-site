<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">
    <!-- Title Page-->
    <title>Ibanov ADMIN - @yield('page-title')</title>
    @include('admin.layout.scripts.main-css')
    @stack('page-css')
</head>
<body class="animsition">
<div class="page-wrapper">
@include('admin.layout.partials.header-mobile')
@include('admin.layout.partials.menu-sidebar')
<!-- PAGE CONTAINER-->
    <div class="page-container">
    @include('admin.layout.partials.header-desktop')
    <!-- MAIN CONTENT-->
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <ol class="breadcrumb">
                                @yield('breadcrumb')
                            </ol>
                        </div>
                    </div>
                    @yield('content')
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT-->
    </div>
    <!-- END PAGE CONTAINER-->
</div>
@include('admin.layout.scripts.main-js')
@stack('page-js')
</body>
</html>
<!-- end document-->
