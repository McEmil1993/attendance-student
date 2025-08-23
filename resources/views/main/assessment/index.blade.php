@extends('layouts.main')

@push('styles')
    <!-- ================== BEGIN page-css ================== -->
    <link href="/assets/plugins/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <link href="/assets/plugins/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css"
        rel="stylesheet" />
        
    <!-- ================== END page-css ================== -->

    <!-- ================== BEGIN page-css ================== -->
<link href="/assets/plugins/lightbox2/dist/css/lightbox.css" rel="stylesheet" />
<!-- ================== END page-css ================== -->
@endpush

@section('content')
    <ol class="breadcrumb float-xl-end">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item active"><a href="/">Student Assessment</a></li>
    </ol>

    <h1 class="page-header">Student Assessment</h1>
    <div class="row">
        <div class="col-12 mb-2">
            <div class="card border-0">
                <div class="card-body">
                    <div class="row mb-2">

                        <div class="col-12 pt-2">
                            @foreach ($terms as $term)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="term_choice"
                                        id="term{{ $term->id }}" value="{{ $term->id }}">
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
                            @foreach ($course_year_blocks as $cyb)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="course_year_block_choice"
                                        id="cyb{{ $cyb->course . '-' . $cyb->year . '-' . $cyb->block }}"
                                        value="{{ $cyb->course . '|' . $cyb->year . '|' . $cyb->block }}">
                                    <strong> <label class="form-check-label"
                                            for="cyb{{ $cyb->course . '-' . $cyb->year . '-' . $cyb->block }}">
                                            {{ $cyb->course . ' - ' . $cyb->year . ' Block ' . $cyb->block }}
                                        </label></strong>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-12">
                            <hr>
                        </div>

                        <div class="col-12 pt-2">
                            @php
                                $prevPrefix = null;
                            @endphp

                            @foreach ($assessment as $assess)
                                @php
                                    $prefix = strtok($assess->name, ' ');
                                @endphp

                                {{-- Break line kapag nagbago ang prefix --}}
                                @if ($prevPrefix !== null && $prevPrefix !== $prefix)
                                    <br>
                                @endif

                                <div class="form-check form-check-inline mb-3">
                                    <input class="form-check-input" type="radio" name="assessment_choice"
                                        {{-- iisa lang name sa lahat --}} id="radio{{ $assess->id }}" value="{{ $assess->id }}">
                                    <strong>
                                        <label class="form-check-label" for="radio{{ $assess->id }}">
                                            {{ $assess->name }}
                                        </label>
                                    </strong>
                                </div>

                                @php
                                    $prevPrefix = $prefix;
                                @endphp
                            @endforeach



                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card border-0 text-center">
                <div class="card-body">
                    <a href="javascript:;" id="audioBtn" class="btn btn-default btn-sm me-1 mb-1">Name</a>
                    <a href="javascript:;" id="audioBtn2" class="btn btn-default btn-sm me-1 mb-1">Score</a>
                    <table id="data-table-assess" width="100%"
                        class="table table-striped table-bordered align-middle text-nowrap">
                        <thead>
                            <tr>
                                <th width="1%">ID-Number</th>
                                <th width="1%" data-orderable="false"></th>
                                <th class="text-nowrap">Fullname</th>
                                <th width="1%">Gender</th>
                                <th class="text-nowrap">Course - Year - Block</th>
                                <th class="text-nowrap">Score</th>
                                <th width="1%">Top Score</th>
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
    <script src="/assets/js/demo/table-manage-default.demo.js"></script>
    <script src="/assets/plugins/@highlightjs/cdn-assets/highlight.min.js"></script>
    <script src="/assets/js/demo/render.highlight.js"></script>

    <script src="/assets/plugins/isotope-layout/dist/isotope.pkgd.min.js"></script>
<script src="/assets/plugins/lightbox2/dist/js/lightbox.min.js"></script>
<script src="//assets/js/demo/gallery.demo.js"></script>
<script>
window.SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition || null;

if (!window.SpeechRecognition) {
    console.error("Speech Recognition not supported.");
} else {
    const recog2 = new window.SpeechRecognition();
    recog2.lang = 'en-US'; // pwede gawing 'fil-PH'
    recog2.interimResults = false;
    recog2.continuous = false; // auto stop

    recog2.onstart = () => {
        console.log("🎤 Listening for score...");
    };

    recog2.onresult = (event) => {
        let spokenText = event.results[0][0].transcript.trim();
        
        // Try parse to number
        let scoreValue = parseInt(spokenText.replace(/[^0-9]/g, ''), 10);

        if (isNaN(scoreValue)) {
            alert("Hindi ko naintindihan ang numero.");
            return;
        }

        // Set to input & focus
        const scoreInput = document.querySelector('.score-input');
        scoreInput.value = scoreValue;
        scoreInput.focus(); // <-- activate / focus the input

        // Trigger "input" event kung may listener
        scoreInput.dispatchEvent(new Event('input', { bubbles: true }));
    };

    recog2.onerror = (e) => {
        console.error("Speech error:", e.error);
    };

    recog2.onend = () => {
        console.log("✅ Finished listening for score.");
    };

    document.getElementById('audioBtn2').addEventListener('click', () => {
        try { recog2.start(); } catch(e) {}
    });
}
</script>
    <script>
window.SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition || null;

if (!window.SpeechRecognition) {
    console.error("Speech Recognition not supported.");
} else {
    const recog = new window.SpeechRecognition();
    recog.lang = 'en-US'; // or 'fil-PH'
    recog.interimResults = false;
    recog.continuous = false; // auto stop when done

    recog.onstart = () => {
        console.log("🎤 Listening...");
    };

    recog.onresult = (event) => {
        const text = event.results[0][0].transcript;
        const searchInput = document.getElementById('dt-search-1');
        searchInput.value = text;

        // trigger "input" event para gumana sa DataTables search
        searchInput.dispatchEvent(new Event('input', { bubbles: true }));
    };

    recog.onerror = (e) => {
        console.error("Speech error:", e.error);
    };

    recog.onend = () => {
        console.log("✅ Finished listening.");
    };

    document.getElementById('audioBtn').addEventListener('click', () => {
        try { recog.start(); } catch(e) {}
    });
}
</script>

    <script>
        let assessTable;

        $(document).ready(function() {
            if ($('#data-table-assess').length !== 0) {
                assessTable = $('#data-table-assess').DataTable({
                    responsive: true,
                    destroy: true,
                    ordering: false,
                    data: [],
                    columns: [{
                            data: "id_number",
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
                            data: "score",
                            className: "text-start"
                        },
                        {
                            data: "top_score",
                            className: "text-start"
                        }
                    ]
                });
            }

            function showTableLoading() {
                // Clear table and show loading row
                assessTable.clear().draw();
                $("#data-table-assess tbody").html(`
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

            // Sa dulo ng $(document).ready(), mag-add ng event listener
            $('#data-table-assess tbody').on('blur', '.score-input', function() {
                const input = $(this);
                const studentId = input.data('student-id');
                let score = parseFloat(input.val());

                if (isNaN(score) || score < 0) {
                    console.log("Please enter a valid non-negative number for score.");
                    input.val('0'); // reset or empty string if you want
                    return;
                }

                // Get the top_score from the same row
                const row = input.closest('tr');
                const topScoreText = row.find('strong').text(); // top_score column has <strong> tag
                let topScore = parseFloat(topScoreText);

                if (isNaN(topScore)) {
                    console.error('Top score is not a number:', topScoreText);
                    topScore = 0; // fallback value
                }

                if (score > topScore) {
                    console.log(`Invalid score! Score cannot be greater than top score (${topScore}).`);
                    input.val(topScore); // set input to max allowed
                    return;
                }

                if (score != 0) {
                    console.log("Student-id: " + studentId + " score:" + score);

                    $.ajax({
                        url: "/set-score",
                        type: "POST",
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                        },
                        data: {
                            id: studentId,
                            score: score, // <-- send the number value, not jQuery object
                        },
                        success: function(response) {
                            if(score != 0){
                                $('.change-b-'+studentId).removeClass('bg-red-500')
                                $('.change-b-'+studentId).html('Done')
                                $('.change-b-'+studentId).addClass('bg-success-600')
                            }else{
                                $('.change-b-'+studentId).removeClass('bg-success-500')
                                $('.change-b-'+studentId).html('Pending')
                                $('.change-b-'+studentId).addClass('bg-red-600')
                            }
                            

                          
                            console.log(response);
                        },
                        error: function(xhr) {
                            console.error("Error:", xhr.responseText);
                        }
                    });
                }
            });

            // $.ajax({
            //     url: '/update_score',
            //     method: 'POST',
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     },
            //     data: {
            //         student_id: studentId,
            //         score: score
            //     },
            //     success: function(response) {
            //         console.log('Score updated successfully for student id:', studentId);
            //     },
            //     error: function(xhr) {
            //         console.error('Error updating score:', xhr.responseText);
            //         alert('Failed to update score.');
            //     }
            // });


            function getSelectedValues() {
                let term = $("input[name='term_choice']:checked").val() || null;
                let cyb = $("input[name='course_year_block_choice']:checked").val() || null;
                let assess = $("input[name='assessment_choice']:checked").val() || null;

                let course = cyb ? cyb.split('|')[0] : null;
                let year = cyb ? cyb.split('|')[1] : null;
                let block = cyb ? cyb.split('|')[2] : null;

                showTableLoading();

                $.ajax({
                    url: "/get_student_enroll",
                    type: "POST",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    },
                    data: {
                        term_choice: term,
                        course: course,
                        year: year,
                        block: block,
                        assessment_choice: assess
                    },
                    
                    success: function(response) {
                        let tableData = response.map(function(item) {
                            return {
                                id_number: `<span class="fw-bold">${item.student.id_number}</span>`,
                                image: `<a href="${item.student.student_profile_path || '/assets/img/user/user-12.jpg'}" data-lightbox="gallery-group-1"><img src="${item.student.student_profile_path || '/assets/img/user/user-12.jpg'}" class="rounded h-30px my-n1 mx-n1" /></a>`,
                                fullname: `${item.student.lastname}, ${item.student.firstname} ${item.student.middle_initial}.`,
                                gender: `<label class="badge ${item.student.gender === 'Female' ? 'bg-pink-300' : 'bg-blue-400'}">
                                    ${item.student.gender}
                                 </label>`,
                                course_year_block: `${item.student.course} - ${item.student.year} - Block ${item.student.block}`,
                                score: `<div class="row">
                                            <div class="col-6">
                                                <input
                                                class="form-control form-control-sm score-input"
                                                type="number"

                                                value="${item.score || '0'}"
                                                placeholder="Input Score"
                                                data-student-id="${item.id}"
                                                max="${item.assessment.top_score}"
                                                >
                                            </div>
                                            <div class="col-6">
                                                <label class="change-b-${item.id} badge ${item.score === 0 ? 'bg-red-500' : 'bg-success-600'}">
                                                ${item.score ===  0 ? 'Pending' : 'Done'}
                                                </label>
                                            </div>

                                        </div>`,
                                top_score: `<strong>${item.assessment.top_score}</strong>`
                            };
                        });

                        assessTable.clear().rows.add(tableData).draw();
                    },
                    error: function(xhr) {
                        console.error("Error:", xhr.responseText);
                        $("#data-table-assess tbody").html(`
                            <tr>
                                <td colspan="6" class="text-center text-danger py-4">
                                    Error loading data.
                                </td>
                            </tr>
                        `);
                    }
                });
            }

            $("input[name='term_choice'], input[name='course_year_block_choice'], input[name='assessment_choice']")
                .on("change", function() {
                    getSelectedValues();
                });
        });
    </script>


    <!-- ================== END page-js ================== -->
@endpush
