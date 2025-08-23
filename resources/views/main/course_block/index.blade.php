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
    <li class="breadcrumb-item active"><a href="/">Courses / Block</a></li>
</ol>

<h1 class="page-header">Courses / Block</h1>

<div class="panel panel-inverse">
    <div class="panel-heading">
        <h4 class="panel-title">Courses list</h4>
        <!-- <a href="javascript:;" class="btn btn-default btn-xs me-1 mb-1">Extra Small</a> -->
        <div class="panel-heading-btn">
            <a href="#modal-dialog" class="btn btn-primary btn-icon btn-circle btn-sm" title="Add Student"
                data-bs-toggle="modal"><i class="fa fa-plus"></i></a>
        </div>
    </div>
    <div class="panel-body">
        <table id="data-table-default" width="100%" class="table table-striped table-bordered align-middle text-nowrap">
            <thead>
                <tr>
                    <th width="1%">#</th>
                    <th class="text-nowrap">Course</th>
                    <th class="text-nowrap">Year</th>
                    <th class="text-nowrap">Block</th>
                    <th width="1%">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr class="odd gradeX">
                    <td width="1%" class="fw-bold">1</td>
                    <td>Trident</td>
                    <td>Internet Explorer 4.0</td>
                    <td>Win 95+</td>
                    <td>
                        <div class="btn-group">
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                data-bs-target="#edit-course-modal">Edit</button>
                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#archiveModal">Archive</button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- #modal-dialog -->
<!-- New Course Modal -->
<div class="modal fade" id="modal-dialog" tabindex="-1" aria-labelledby="newCourseLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title" id="newCourseLabel">
                    <i class="fa fa-plus-circle me-1"></i> New Course
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form id="courseForm">
                    <div class="mb-3">
                        <label class="form-label">Course Name</label>
                        <input class="form-control form-control-sm" type="text" name="course_name" placeholder="Enter Course Name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Course Code</label>
                        <input class="form-control form-control-sm" type="text" name="course_code" placeholder="Enter Course Code">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Year</label>
                        <input class="form-control form-control-sm" type="number" name="year" placeholder="Enter Year">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Block</label>
                        <input class="form-control form-control-sm" type="number" name="block" placeholder="Enter Block">
                    </div>
                </form>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                    <i class="fa fa-times me-1"></i> Cancel
                </button>
                <button type="submit" form="courseForm" class="btn btn-primary btn-sm">
                    <i class="fa fa-save me-1"></i> Save
                </button>
            </div>

        </div>
    </div>
</div>

<!-- Edit Course Modal -->
<!-- Edit Course Modal -->
<div class="modal fade" id="edit-course-modal" tabindex="-1" aria-labelledby="editCourseLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title" id="editCourseLabel">
                    <i class="fa fa-edit me-1"></i> Edit Course
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form id="editCourseForm">
                    
                    <!-- Hidden ID -->
                    <input type="hidden" id="edit_course_id" name="course_id">

                    <div class="mb-3">
                        <label for="edit_course_name" class="form-label">Course Name</label>
                        <input class="form-control form-control-sm" type="text" id="edit_course_name" name="course_name" placeholder="Enter Course Name">
                    </div>

                    <div class="mb-3">
                        <label for="edit_course_code" class="form-label">Course Code</label>
                        <input class="form-control form-control-sm" type="text" id="edit_course_code" name="course_code" placeholder="Enter Course Code">
                    </div>

                    <div class="mb-3">
                        <label for="edit_year" class="form-label">Year</label>
                        <input class="form-control form-control-sm" type="text" id="edit_year" name="year" placeholder="Enter Year">
                    </div>

                    <div class="mb-3">
                        <label for="edit_block" class="form-label">Block</label>
                        <input class="form-control form-control-sm" type="text" id="edit_block" name="block" placeholder="Enter Block">
                    </div>
                </form>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                    <i class="fa fa-times me-1"></i> Cancel
                </button>
                <button type="submit" form="editCourseForm" class="btn btn-warning btn-sm">
                    <i class="fa fa-save me-1"></i> Update
                </button>
            </div>

        </div>
    </div>
</div>




<div class="modal fade" id="editCourseModal" tabindex="-1" aria-labelledby="editCourseLabel" aria-hidden="true">
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