@extends('admin.layout.master')
@include('admin.user.scripts.css')
@include('admin.user.scripts.js')
@section('page-title', 'Gestão de usuários')
@section('breadcrumb')
    <li class="breadcrumb-item">
        Admin
    </li>
    <li class="breadcrumb-item active">
        Usuários
    </li>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="table-data__tool">
                <div class="table-data__tool-left"></div>
                <div class="table-data__tool-right">
                    <button class="au-btn au-btn-icon au-btn--blue au-btn--small">
                        <i class="zmdi zmdi-plus"></i> Novo usuário
                    </button>
                </div>
            </div>
            <div class="table-responsive table-responsive-data2">
                <table class="table table-data2 table-user">
                    {{--                    <thead>--}}
                    {{--                    <tr>--}}
                    {{--                        <th>name</th>--}}
                    {{--                        <th>email</th>--}}
                    {{--                        <th>description</th>--}}
                    {{--                        <th>date</th>--}}
                    {{--                        <th>status</th>--}}
                    {{--                        <th>price</th>--}}
                    {{--                        <th>Opções</th>--}}
                    {{--                    </tr>--}}
                    {{--                    </thead>--}}
                    {{--                    <tbody>--}}
                    {{--                    @foreach([1,2,3,4,5] as$fake)--}}
                    {{--                        <tr class="tr-shadow">--}}
                    {{--                            <td>Lori Lynch</td>--}}
                    {{--                            <td>lori@example.com</td>--}}
                    {{--                            <td class="desc">Samsung S8 Black</td>--}}
                    {{--                            <td>2018-09-27 02:12</td>--}}
                    {{--                            <td>--}}
                    {{--                                <span class="status--process">Processed</span>--}}
                    {{--                            </td>--}}
                    {{--                            <td>$679.00</td>--}}
                    {{--                            <td>--}}
                    {{--                                <div class="table-data-feature">--}}
                    {{--                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Alterar">--}}
                    {{--                                        <i class="zmdi zmdi-edit text-warning"></i>--}}
                    {{--                                    </button>--}}
                    {{--                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Remover">--}}
                    {{--                                        <i class="zmdi zmdi-delete text-danger"></i>--}}
                    {{--                                    </button>--}}
                    {{--                                </div>--}}
                    {{--                            </td>--}}
                    {{--                        </tr>--}}
                    {{--                        <tr class="spacer"></tr>--}}
                    {{--                    @endforeach--}}
                    {{--                    </tbody>--}}
                </table>
            </div>
        </div>
    </div>
@endsection
