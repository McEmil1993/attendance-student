@extends('layouts.main')

@push('styles')
<!-- ================== BEGIN page-css ================== -->
<link href="{{ asset('assets/plugins/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}"
    rel="stylesheet" />
<!-- ================== END page-css ================== -->
@endpush

@section('content')
<ol class="breadcrumb float-xl-end">
    <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
    <li class="breadcrumb-item active"><a href="/">Student Handle</a></li>
</ol>

<h1 class="page-header">Student Handle</h1>

<div class="panel panel-inverse">
    <div class="panel-heading">
        <h4 class="panel-title">Student List</h4>
        <div class="btn-group btn-group-toggle my-n1" data-toggle="buttons">
           
        </div>
    </div>
    <div class="panel-body">
        <table id="data-table-default" width="100%" class="table table-striped table-bordered align-middle text-nowrap">
            <thead>
                <tr>
                    <th width="1%">Room</th>
                    <th width="1%"></th>
                    <th width="1%" data-orderable="false"></th>
                    <th class="text-nowrap">Student Name</th>
                    <th width="1%">Gender</th>
                    <th width="1%">Course - Year</th>
                    <th width="1%">Block</th>
                    <th class="text-nowrap">Address</th>


                </tr>
            </thead>
            <tbody>
                @foreach($handles as $handle)


                <tr class="odd gradeX">
                    <td>{{ $handle->room_assign }}</td>
                    <td width="1%" class="fw-bold">{{ $handle->student->id_number }}</td>
                    <td width="1%" class="with-img"><img src="{{ asset('assets/img/user/user-12.jpg') }}"
                            class="rounded h-30px my-n1 mx-n1" /></td>
                    <td>{{ $handle->student->lastname }}, {{ $handle->student->firstname }}</td>
                    <td>{{ $handle->student->gender }}</td>
                    <td>{{ $handle->student->course }} {{ $handle->student->year }}</td>
                    <td>Block {{ $handle->student->block }}</td>
                    <td>{{ $handle->student->address }}</td>

                   
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>



@endsection

@push('scripts')
<!-- ================== BEGIN page-js ================== -->

<script src="{{ asset('assets/plugins/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
<script src="{{ asset('assets/js/demo/table-manage-default.demo.js') }}"></script>
<script src="{{ asset('assets/plugins/@highlightjs/cdn-assets/highlight.min.js') }}"></script>
<script src="{{ asset('assets/js/demo/render.highlight.js') }}"></script>
<!-- ================== END page-js ================== -->
@endpush