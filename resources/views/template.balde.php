@extends('layouts.main')

@push('styles')
<!-- ================== BEGIN page-css ================== -->
<link href="/assets/plugins/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
<link href="/assets/plugins/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css"
    rel="stylesheet" />
<!-- ================== END page-css ================== -->
@endpush

@section('content')
<ol class="breadcrumb float-xl-end">
    <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
    <li class="breadcrumb-item active"><a href="/">Student Manage</a></li>
</ol>

<h1 class="page-header">Student Manage</h1>

<div class="panel panel-inverse">
    <div class="panel-heading">
        <h4 class="panel-title">Student list</h4>
        <!-- <a href="javascript:;" class="btn btn-default btn-xs me-1 mb-1">Extra Small</a> -->
        <div class="panel-heading-btn">
            <a href="#modal-dialog" class="btn btn-primary btn-icon btn-circle btn-sm" title="Add Student" data-bs-toggle="modal"><i
                    class="fa fa-plus"></i></a>
        </div>
    </div>
    <div class="panel-body">
        <table id="data-table-default" width="100%" class="table table-striped table-bordered align-middle text-nowrap">
            <thead>
                <tr>
                    <th width="1%"></th>
                    <th width="1%" data-orderable="false"></th>
                    <th class="text-nowrap">Fullname</th>
                    <th width="1%">Course - Year - Block</th>
                    <th class="text-nowrap">Address</th>
                    <th width="1%">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr class="odd gradeX">
                    <td width="1%" class="fw-bold">12-000000</td>
                    <td width="1%" class="with-img"><img src="/assets/img/user/user-12.jpg"
                            class="rounded h-30px my-n1 mx-n1" /></td>
                    <td>Trident</td>
                    <td>Internet Explorer 4.0</td>
                    <td>Win 95+</td>
                    <td>
                        <div class="btn-group">
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal-dialog">Edit</button>
                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#archiveModal">Archive</button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- #modal-dialog -->
<div class="modal fade" id="modal-dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modal Dialog</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <p>
                    Modal body content here...
                </p>
            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn btn-danger" data-bs-dismiss="modal">Cancel</a>
                <a href="javascript:;" class="btn btn-primary">Action</a>
            </div>
        </div>
    </div>
</div>

<!-- Archive Confirmation Modal -->
<div class="modal fade" id="archiveModal">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">
                    <i class="fa fa-archive me-1"></i> Confirm Archive
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body text-center">
                <p class="mb-0 fs-5">
                    <strong>Are you sure you want to archive this item?</strong>
                </p>
                <small class="text-muted">This action cannot be undone.</small>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fa fa-times me-1"></i> Cancel
                </button>
                <button type="button" class="btn btn-warning" id="confirmArchiveBtn">
                    <i class="fa fa-archive me-1"></i> Yes, Archive
                </button>
            </div>

        </div>
    </div>
</div>

@endsection

@push('scripts')
<!-- ================== BEGIN page-js ================== -->
<script src="/assets/plugins/datatables.net/js/dataTables.min.js"></script>
<script src="/assets/plugins/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
<script src="/assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="/assets/plugins/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
<script src="/assets/js/demo/table-manage-default.demo.js"></script>
<script src="/assets/plugins/@highlightjs/cdn-assets/highlight.min.js"></script>
<script src="/assets/js/demo/render.highlight.js"></script>
<!-- ================== END page-js ================== -->
@endpush