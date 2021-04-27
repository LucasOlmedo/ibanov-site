@extends('admin.layout.master')
@include('admin.event.scripts.js')
@include('admin.event.partials.modal-edit-event')
@section('page-title', 'Gestão de Eventos')
@section('breadcrumb')
    <li class="breadcrumb-item">
        Admin
    </li>
    <li class="breadcrumb-item active">
        Eventos
    </li>
@endsection
@section('content')
    <div class="default-tab">
        <nav>
            <div class="nav nav-pills" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active show" id="nav-home-tab" data-toggle="tab" href="#nav-event-calendar"
                   role="tab" aria-controls="nav-event-calendar" aria-selected="true">
                    <i class="fa fa-calendar m-r-5"></i> Calendário
                </a>
                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-event-edit" role="tab"
                   aria-controls="nav-event-edit" aria-selected="false">
                    <i class="fa fa-th-list m-r-5"></i> Gerenciamento
                </a>
            </div>
        </nav>
        <div class="tab-content p-t-30" id="nav-tabContent">
            <div class="tab-pane fade active show" id="nav-event-calendar" role="tabpanel"
                 aria-labelledby="nav-event-calendar-tab">
                <div id="calendar"></div>
            </div>
            <div class="tab-pane fade" id="nav-event-edit" role="tabpanel" aria-labelledby="nav-event-edit-tab">
                <div class="row">
                    <div class="col-12">
                        <table class="table table-event"></table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('admin.event.partials.month-view')
@include('admin.event.partials.week-view')
@include('admin.event.partials.day-view')
