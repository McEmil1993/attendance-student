@extends('layouts.main')

@push('styles')
<!-- ================== BEGIN page-css ================== -->
<link href="{{ asset('assets/plugins/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}"
    rel="stylesheet" />
<!-- ================== END page-css ================== -->

<!-- ================== BEGIN page-css ================== -->
<link href="{{ asset('assets/plugins/lightbox2/dist/css/lightbox.css') }}" rel="stylesheet" />
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
            <a href="#new-student" class="btn btn-primary btn-icon btn-circle btn-sm" title="Add Student"
                data-bs-toggle="modal"><i class="fa fa-plus"></i></a>
        </div>
    </div>
    <div class="panel-body">
        <table id="data-table-default" width="100%" class="table table-striped table-bordered align-middle text-nowrap">
            <thead>
                <tr>
                    <th width="1%"></th>
                    <th width="1%" data-orderable="false"></th>
                    <th width="1%">Fullname</th>
                    <th width="1%">Gender</th>
                    <th width="1%">Course Year</th>
                    <th width="1%">Block</th>
                    <th class="text-nowrap">Address</th>
                    <th width="1%">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                <tr class="odd gradeX">
                    <td width="1%" class="fw-bold">{{ $student->id_number }}</td>
                    <td width="1%" class="with-img"><a href="{{ $student->student_profile_path ? asset($student->student_profile_path) : asset('assets/img/user/user-12.jpg') }}" data-lightbox="gallery-group-1"><img src="{{ $student->student_profile_path ? asset($student->student_profile_path) : asset('assets/img/user/user-12.jpg') }}" class="rounded h-30px my-n1 mx-n1" /></a></td>
                    <td>{{ $student->lastname }}, {{ $student->firstname }} {{ $student->middle_initial }}.</td>
                    <td>{{ $student->gender }}</td>
                    <td>{{ $student->course }} {{ $student->year }}</td>
                    <td>Block {{ $student->block }}</td>
                    <td>{{ $student->address }}</td>
                    <td>
                        <div class="btn-group">
                            <button class="btn btn-warning btn-sm btn-edit" data-bs-toggle="modal"
                                data-bs-target="#edit-student" data-id="{{ $student->id }}">Edit</button>
                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#archiveModal">Archive</button>
                        </div>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>

<!-- New Student Modal -->
<div class="modal fade" id="new-student" tabindex="-1" aria-labelledby="newStudent" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="newStudent">
                    <i class="fa fa-plus-circle me-1"></i> New Student
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="newCourseForm">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">ID Number</label>
                                <input class="form-control form-control-sm" type="text" name="id_number"
                                    id="new-idnumber" placeholder="Enter ID Number">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">First Name</label>
                                <input class="form-control form-control-sm" type="text" name="firstname"
                                    id="new-firstname" placeholder="Enter First Name">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Last Name</label>
                                <input class="form-control form-control-sm" type="text" name="lastname"
                                    id="new-lastname" placeholder="Enter Last Name">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Middle Initial</label>
                                <input class="form-control form-control-sm" type="text" name="middle_initial"
                                    id="new-middle_initial" placeholder="Enter Middle Initial">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Gender</label>
                                <select class="form-control form-control-sm" name="gender" id="new-gender">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Course</label>
                                <input class="form-control form-control-sm" type="text" name="course" id="new-course"
                                    placeholder="Enter Course">
                            </div>

                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Year</label>
                                <input class="form-control form-control-sm" type="number" name="year" id="new-year"
                                    placeholder="Enter Year">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Block</label>
                                <input class="form-control form-control-sm" type="number" name="block" id="new-block"
                                    placeholder="Enter Block">
                            </div>
                        </div>

                    </div>

                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <input class="form-control form-control-sm" value="None" type="text" name="address"
                            id="new-address" placeholder="Enter Address">
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                        <i class="fa fa-times me-1"></i> Cancel
                    </button>
                    <button type="submit" form="newCourseForm" class="btn btn-primary btn-sm">
                        <i class="fa fa-save me-1"></i> Save
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>


<!-- Edit Student Modal -->
<!-- Edit Student Modal -->
<div class="modal fade" id="edit-student" tabindex="-1" aria-labelledby="editStudentLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="editStudentLabel">
                    <i class="fa fa-edit me-1"></i> Edit Student
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="editStudentForm">
                <input type="hidden" name="id" id="edit-id">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <label class="form-label">ID Number</label>
                            <input class="form-control form-control-sm" type="text" name="id_number" id="edit-idnumber">
                        </div>
                        <div class="col-6">
                            <label class="form-label">First Name</label>
                            <input class="form-control form-control-sm" type="text" name="firstname" id="edit-firstname">
                        </div>
                        <div class="col-6">
                            <label class="form-label">Last Name</label>
                            <input class="form-control form-control-sm" type="text" name="lastname" id="edit-lastname">
                        </div>
                        <div class="col-6">
                            <label class="form-label">Middle Initial</label>
                            <input class="form-control form-control-sm" type="text" name="middle_initial" id="edit-middle_initial">
                        </div>
                        <div class="col-6">
                            <label class="form-label">Gender</label>
                            <select class="form-control form-control-sm" name="gender" id="edit-gender">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Course</label>
                            <input class="form-control form-control-sm" type="text" name="course" id="edit-course">
                        </div>
                        <div class="col-6">
                            <label class="form-label">Year</label>
                            <input class="form-control form-control-sm" type="number" name="year" id="edit-year">
                        </div>
                        <div class="col-6">
                            <label class="form-label">Block</label>
                            <input class="form-control form-control-sm" type="number" name="block" id="edit-block">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Address</label>
                            <input class="form-control form-control-sm" type="text" name="address" id="edit-address">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary btn-sm">
                        Save Changes
                    </button>
                </div>
            </form>

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
<script src="{{ asset('assets/plugins/datatables.net/js/dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/isotope-layout/dist/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/plugins/lightbox2/dist/js/lightbox.min.js') }}"></script>
<script src="{{ asset('assets/js/demo/table-manage-default.demo.js') }}"></script>
<script src="{{ asset('assets/plugins/@highlightjs/cdn-assets/highlight.min.js') }}"></script>
<script src="{{ asset('assets/js/demo/render.highlight.js') }}"></script>

<script src="../assets/js/demo/gallery.demo.js"></script>
<!-- ================== END page-js ================== -->

<script>
    $(document).ready(function() {

        $("#newCourseForm").on("submit", function(e) {
            e.preventDefault();

            let isValid = true;

            // Clear invalid classes before checking
            $("#newCourseForm input").removeClass("is-invalid");

            // Loop sa bawat input para sa validation
            $("#newCourseForm input").each(function() {
                if ($(this).val().trim() === "") {
                    $(this).addClass("is-invalid");
                    isValid = false;
                }
            });

            // Kung hindi valid, wag i-submit
            if (!isValid) {
                return;
            }

            // Kung pasado, send data via AJAX
            $.ajax({
                url: "/students", // route papunta sa store method
                method: "POST",
                data: $(this).serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF protection
                },
                success: function(response) {
                    alert("Student added successfully!");
                    $("#new-student").modal("hide");
                    $("#newCourseForm")[0].reset();
                    setTimeout(function() {
                        location.reload(); // Reload the page to see the new student
                    }, 3000); // Optional: delay for better UX
                    // Pwede mo rin i-refresh yung table dito
                },
                error: function(xhr) {
                    alert("Something went wrong. Please try again. " + xhr.responseJSON.message);
                }
            });

        });

    });
</script>

<script>
    $(document).ready(function() {

        // PAG-CLICK NG EDIT BUTTON
        $(document).on("click", ".btn-edit", function() {
            let studentId = $(this).data("id");

            $.ajax({
                url: "/students/" + studentId + "/edit",
                type: "GET",
                success: function(data) {

                    $("#edit-id").val(data.id);
                    $("#edit-idnumber").val(data.id_number);
                    $("#edit-firstname").val(data.firstname);
                    $("#edit-lastname").val(data.lastname);
                    $("#edit-middle_initial").val(data.middle_initial);
                    $("#edit-gender").val(data.gender);
                    $("#edit-course").val(data.course);
                    $("#edit-year").val(data.year);
                    $("#edit-block").val(data.block);
                    $("#edit-address").val(data.address);

                    // Show Modal
                    $("#edit-student").modal("show");
                },
                error: function() {
                    alert("Error fetching student data.");
                }
            });
        });

        $("#editStudentForm").submit(function(e) {
            e.preventDefault();

            let formData = $(this).serialize();

            $.ajax({
                url: "/students/update",
                type: "POST",
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF protection
                },
                success: function(response) {
                    alert(response.message);
                    $("#edit-student").modal("hide");
                    // Optional: refresh table/list
                    setTimeout(function() {
                        location.reload(); // Reload the page to see the updated student
                    }, 3000); // Optional: delay for better UX
                },
                error: function(e) {
                    alert("Error updating student." + e.responseJSON.message);
                }
            });
        });

    });
</script>

@endpush