@extends('layouts.main')

@push('styles')
    <!-- ================== BEGIN page-css ================== -->
    <link href="/assets/plugins/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <link href="/assets/plugins/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css"
        rel="stylesheet" />
    <!-- ================== BEGIN page-css ================== -->
    <link href="/assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />
    <link href="/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
    <link href="/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet" />
    <link href="/assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" />
    <link href="/assets/plugins/ion-rangeslider/css/ion.rangeSlider.min.css" rel="stylesheet" />
    <link href="/assets/plugins/tag-it/css/jquery.tagit.css" rel="stylesheet" />
    <link href="/assets/plugins/spectrum-colorpicker2/dist/spectrum.min.css" rel="stylesheet" />
    <link href="/assets/plugins/select-picker/dist/picker.min.css" rel="stylesheet" />
    <!-- ================== END page-css ================== -->

    <!-- ================== BEGIN page-css ================== -->
<link href="/assets/plugins/lightbox2/dist/css/lightbox.css" rel="stylesheet" />
<!-- ================== END page-css ================== -->

    <!-- ================== END page-css ================== -->

    <style>
        /* Kapag naka-check, magiging pula */
        .switch-red:checked {
            background-color: #05c435ff;
            /* Bootstrap red */
            border-color: #05c435ff;
        }

        /* Optional: para sa hover effect */
        .switch-red:checked:hover {
            background-color: #035c19ff;
            border-color: #035c19ff;
        }

        /* Default state kapag hindi naka-check */
        .switch-red:not(:checked) {
            background-color: #dc3545;
            /* pula */
            border-color: #dc3545;
        }

        /* Hover effect kung hindi naka-check */
        .switch-red:not(:checked):hover {
            background-color: #bb2d3b;
            border-color: #b02a37;
        }
    </style>
@endpush

@section('content')
    <ol class="breadcrumb float-xl-end">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item active"><a href="/">Student Attendance</a></li>
    </ol>

    <h1 class="page-header">Student Attendance</h1>
    <!-- fetchAttendances -->
    <div class="row">
        <div class="col-12 mb-2">
            <div class="card border-0">
                <div class="card-body">
                    <div class="row mb-2">


                        <div class="col-12 pt-2">
                            @foreach ($terms as $term)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="term_choice"
                                        @if ($term->id == 1) checked @endif id="term{{ $term->id }}"
                                        value="{{ $term->id }}">
                                    <strong>
                                        <label class="form-check-label" for="term{{ $term->id }}">
                                            {{ $term->name }}
                                        </label>
                                    </strong>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-12">
                            <hr>
                        </div>



                        <div class="col-12 pt-2">
                            @php
                                $currentYear = null;
                            @endphp

                            @foreach ($course_year_blocks as $cyb)
                                @if ($cyb->year !== $currentYear)
                                    @if ($currentYear !== null)
                        </div> {{-- close previous year div --}}
                        @endif
                        <div class="year-group mb-3"> {{-- new year group --}}

                            @php $currentYear = $cyb->year; @endphp
                            @endif

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="course_year_block_choice"
                                    id="cyb{{ $cyb->course . '-' . $cyb->year . '-' . $cyb->block }}"
                                    value="{{ $cyb->course . '|' . $cyb->year . '|' . $cyb->block }}">
                                <label class="form-check-label"
                                    for="cyb{{ $cyb->course . '-' . $cyb->year . '-' . $cyb->block }}">
                                    <strong>{{ $cyb->course . ' - ' . $cyb->year . ' Block ' . $cyb->block }}</strong>
                                </label>
                            </div>

                            @if ($loop->last)
                        </div> {{-- close last year group --}}
                        @endif
                        @endforeach
                    </div>
                    <div class="col-12" style="marigin-top: -1000px !important">
                        <hr>
                    </div>
                    <div class="col-12">
                        <div class="form-group row justify-content-end align-items-center">
                            {{-- <label class="form-label col-form-label col-2 text-end" style="">Choose date:</label> --}}
                            <div class="col-lg-12 d-flex justify-content-end align-items-center">
                                <strong>
                                    <span class="me-2" style="font-size: 13px;">Choose date:</span>
                                </strong>
                                <input type="text" class="form-control" id="datepicker-default" placeholder="Select Date"
                                    style="width: 25ch;" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card border-0">
            <div class="card-body">
                <table id="data-table-attendance" width="100%"
                    class="table table-striped table-bordered align-middle text-nowrap">
                    <thead>
                        <tr>
                            <th width="1%">ID-Number</th>
                            <th width="1%">Action</th>
                            <th width="1%" data-orderable="false">IMG</th>
                            <th class="text-nowrap">Fullname</th>
                            <th width="1%">Gender</th>
                            <th>Course - Year - Block</th>
                            <th width="1%">Date</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
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




    <!-- ================== BEGIN page-js ================== -->
    <script src="/assets/plugins/moment/min/moment.min.js"></script>
    <script src="/assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="/assets/plugins/select2/dist/js/select2.min.js"></script>
    <script src="/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
    <script src="/assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
    <script src="/assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js"></script>
    <script src="/assets/plugins/jquery.maskedinput/src/jquery.maskedinput.js"></script>
    <script src="/assets/plugins/jquery-migrate/dist/jquery-migrate.min.js"></script>
    <script src="/assets/plugins/tag-it/js/tag-it.min.js"></script>
    <script src="/assets/plugins/clipboard/dist/clipboard.min.js"></script>
    <script src="/assets/plugins/spectrum-colorpicker2/dist/spectrum.min.js"></script>
    <script src="/assets/plugins/select-picker/dist/picker.min.js"></script>
    <script src="/assets/js/demo/form-plugins.demo.js"></script>

    <script src="/assets/js/demo/table-manage-default.demo.js"></script>
    <script src="/assets/plugins/@highlightjs/cdn-assets/highlight.min.js"></script>
    <script src="/assets/js/demo/render.highlight.js"></script>


    <script src="/assets/plugins/isotope-layout/dist/isotope.pkgd.min.js"></script>
<script src="/assets/plugins/lightbox2/dist/js/lightbox.min.js"></script>
<script src="//assets/js/demo/gallery.demo.js"></script>


    <script>
        const formatDate = (date) => {
            const mm = String(date.getMonth() + 1).padStart(2, '0');
            const dd = String(date.getDate()).padStart(2, '0');
            const yyyy = date.getFullYear();
            return `${mm}/${dd}/${yyyy}`;
        };

        const today = new Date();
        document.getElementById('datepicker-default').value = formatDate(today);
    </script>
    <!-- ================== END page-js ================== -->


    {{-- <script>
            $("#datepicker-default").datepicker({
                todayHighlight: true
            });
        </script> --}}
    <!-- ================== END page-js ================== -->
    <!-- <script>
        if ($('#data-table-attendance').length !== 0) {
            $('#data-table-attendance').DataTable({
                responsive: true
            });
        }
    </script> -->

    <script>
        let assessTable;

        $(document).ready(function() {

            if ($('#data-table-attendance').length !== 0) {

                assessTable = $('#data-table-attendance').DataTable({
                    responsive: true,
                    destroy: true,
                    ordering: false,
                    data: [],
                    columns: [{
                            data: "id_number",
                            className: "text-start"
                        },
                        {
                            data: "status",
                            className: "text-start"
                        },
                        {
                            data: "image",
                            orderable: false,
                            className: "text-start"
                        },
                        {
                            data: "fullname",
                            className: "text-start"
                        },
                         
                        {
                            data: "gender",
                            className: "text-start"
                        },
                        {
                            data: "course_year_block",
                            className: "text-start"
                        },
                       
                        {
                            data: "date",
                            className: "text-start"
                        },
                    ]
                });

                getSelectedValues();
            }

            function showTableLoading() {
                assessTable.clear().draw();
                $("#data-table-attendance tbody").html(`
                <tr>
                    <td colspan="7" class="text-center py-4">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="mt-2">Loading data, please wait...</div>
                    </td>
                </tr>
            `);
            }

            function getSelectedValues() {
                let term = $("input[name='term_choice']:checked").val() || '1';
                let cyb = $("input[name='course_year_block_choice']:checked").val() || null;

                let datepick = $("#datepicker-default").val()

                let course = cyb ? cyb.split('|')[0] : null;
                let year = cyb ? cyb.split('|')[1] : null;
                let block = cyb ? cyb.split('|')[2] : null;

                showTableLoading();

                $.ajax({
                    url: "/get-attendance",
                    type: "POST",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    },
                    data: {
                        term_choice: term,
                        course: course,
                        year: year,
                        block: block,
                        datepick: datepick
                    },
                    success: function(response) {
                        let tableData = response.map(function(item) {
                            return {
                                id_number: `<span class="fw-bold">${item.student.id_number}</span>`,
                                status: `
                                <div class="form-check form-switch ms-auto">
                                    <input type="checkbox" class="form-check-input switch-red"
                                        id="status_${item.id}"
                                        name="status_switch"
                                        data-id="${item.id}"
                                        value="${item.status}"
                                        ${item.status === 'present' ? 'checked' : ''} />
                                    <label class="form-check-label" for="status_${item.id}">
                                        ${item.status}
                                    </label>
                                </div>
                            `,
                                image: `<a href="${item.student.student_profile_path || '/assets/img/user/user-12.jpg'}" data-lightbox="gallery-group-1"><img src="${item.student.student_profile_path || '/assets/img/user/user-12.jpg'}" class="rounded h-30px my-n1 mx-n1" /></a>`,
                                fullname: `${item.student.lastname}, ${item.student.firstname} ${item.student.middle_initial}.`,
                                 
                                gender: `<label class="badge ${item.student.gender === 'Female' ? 'bg-pink-300' : 'bg-blue-400'}">
                                        ${item.student.gender}
                                     </label>`,
                                course_year_block: `${item.student.course} - ${item.student.year} - Block ${item.student.block}`,
                               
                                date: (() => {
                                    if (!item.attend_date) return '';
                                    const date = new Date(item.attend_date);
                                    const weekdays = ["Sunday", "Monday", "Tuesday",
                                        "Wednesday", "Thursday", "Friday",
                                        "Saturday"
                                    ];
                                    const months = ["January", "February", "March",
                                        "April", "May", "June",
                                        "July", "August", "September", "October",
                                        "November", "December"
                                    ];
                                    return `${weekdays[date.getDay()]}, ${String(date.getDate()).padStart(2, '0')} ${months[date.getMonth()]} ${date.getFullYear()}`;
                                })()
                            };
                        });

                        assessTable.clear().rows.add(tableData).draw();
                    },
                    error: function(xhr) {
                        console.error("Error:", xhr.responseText);
                        $("#data-table-attendance tbody").html(`
                        <tr>
                            <td colspan="6" class="text-center text-danger py-4">
                                Error loading data.
                            </td>
                        </tr>
                    `);
                    }
                });
            }

            $("input[name='term_choice'], input[name='course_year_block_choice'], #datepicker-default")
                .on("change", function() {
                    getSelectedValues();
                });

            // ✅ Listener para sa status switch update
            $(document).on('change', 'input[name="status_switch"]', function() {
                const checkbox = $(this);
                const attendanceId = checkbox.data('id');
                const newStatus = checkbox.is(':checked') ? 'present' : 'absent';
                const label = checkbox.next('label.form-check-label');
                label.text(newStatus);

                $.ajax({
                    url: '/update-attendance-status', // Laravel route mo
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        id: attendanceId,
                        status: newStatus
                    },
                    success: function() {


                    },
                    error: function() {
                        alert('Error updating status.');
                        checkbox.prop('checked', !checkbox.is(':checked')); // rollback state
                    }
                });
            });

        });
    </script>
@endpush
