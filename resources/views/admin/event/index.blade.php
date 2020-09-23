@extends('admin.layout.master')
@include('admin.event.scripts.js')
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
    <div id="calendar"></div>
@endsection
@include('admin.event.partials.month-view')
@include('admin.event.partials.week-view')
@include('admin.event.partials.day-view')
