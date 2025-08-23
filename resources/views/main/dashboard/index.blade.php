@extends('layouts.main')
@push('styles')

@endpush
@section('content')
<ol class="breadcrumb float-xl-end">
    <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
    <li class="breadcrumb-item active"><a href="/">Dashboard</a></li>
</ol>

<h1 class="page-header">Dashboard</h1>


<div class="panel panel-inverse">
    <div class="panel-heading">
        <h4 class="panel-title">Student list</h4>
        <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i
                    class="fa fa-expand"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i
                    class="fa fa-redo"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i
                    class="fa fa-minus"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i
                    class="fa fa-times"></i></a>
        </div>
    </div>
    <div class="panel-body">
        <table id="data-table-default" width="100%" class="table table-striped table-bordered align-middle text-nowrap">
            <thead>
                <tr>
                    <th width="1%"></th>
                    <th width="1%" data-orderable="false"></th>
                    <th class="text-nowrap">Rendering engine</th>
                    <th class="text-nowrap">Browser</th>
                    <th class="text-nowrap">Platform(s)</th>
                    <th class="text-nowrap">Engine version</th>
                    <th class="text-nowrap">CSS grade</th>
                </tr>
            </thead>
            <tbody>
                <tr class="odd gradeX">
                    <td width="1%" class="fw-bold">1</td>
                    <td width="1%" class="with-img"><img src="/assets/img/user/user-12.jpg"
                            class="rounded h-30px my-n1 mx-n1" /></td>
                    <td>Trident</td>
                    <td>Internet Explorer 4.0</td>
                    <td>Win 95+</td>
                    <td>4</td>
                    <td>X</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')

@endpush