<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{ $title ?? 'Dashboard' }} | Color Admin</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <link href="{{ asset('assets/css/vendor.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/apple/app.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets/plugins/ionicons/dist/ionicons/ionicons.js') }}"></script>

    @stack('styles')
</head>

<body>
    <div id="loader" class="app-loader">
        <span class="spinner"></span>
    </div>

    <div id="app" class="app app-header-fixed app-sidebar-fixed">
        {{-- Top Navigation --}}
        @include('components.topnav')

        {{-- Sidebar Navigation --}}
        @include('components.sidenav')

        {{-- Content --}}
        <div id="content" class="app-content">
            @yield('content')
        </div>
        <!-- Offcanvas -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEndExample">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title"><a href="javascript:;" id="assign-btn" class="btn btn-primary btn-xs me-1 mb-1">Generate</a>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
                <!-- Loading spinner -->
                <div id="loading-spinner" class="text-center my-3" style="display: none;">
                    <div class="spinner-border text-primary" role="status"></div>
                    <p>Loading data...</p>
                </div>

                <!-- Table -->
                <table id="data-table-side" class="table mb-0" style="display: none;">
                    <thead>
                        <tr>
                            <th>ID #</th>
                            <th>Name</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>

        {{-- Footer --}}
        @include('components.footer')
    </div>

    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables.net/js/dataTables.min.js') }}"></script>
    @stack('scripts')
    <script>
    let studentsTable;

    $('#load-students').on('click', function() {
        // Show loading spinner
        $('#loading-spinner').show();
        $('#data-table-side').hide();

        // Destroy table if already initialized
        if ($.fn.DataTable.isDataTable('#data-table-side')) {
            $('#data-table-side').DataTable().destroy();
            $('#data-table-side tbody').empty();
        }

        // Delay para makita yung spinner kahit mabilis ang API
        setTimeout(function() {
            studentsTable = $('#data-table-side').DataTable({
                responsive: true,
                paging: false,
                info: false,
                searching: true,
                autoWidth: false,
                ordering: false, // walang sorting
                ajax: {
                    url: '/api/students',
                    dataSrc: ''
                },
                columns: [{
                        data: 'id_num'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'course_info'
                    }
                ],
                initComplete: function() {
                    // Hide spinner and show table
                    $('#loading-spinner').hide();
                    $('#data-table-side').show();
                }
            });
        }, 500); // Optional delay para makita spinner
    });
    </script>
    <script>
    $('#assign-btn').click(function(e) {
        e.preventDefault();

        $.ajax({
            url: '/assign-students',
            method: 'POST',
            data: {
                instructor_id: "1",
                room_assign: "None",
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                alert(response.message);
            },
            error: function(xhr) {
                alert('Error: ' + xhr.responseJSON.message);
            }
        });
    });
    </script>
</body>

</html>