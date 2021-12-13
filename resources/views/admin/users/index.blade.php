@extends('commonDashboard.master')

@push('styles')
    <link href="{{ asset('panel/plugins/animate/animate.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('panel/plugins/table/datatable/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('panel/plugins/table/datatable/dt-global_style.css') }}">
@endpush

@section('content')

    <div class="row layout-top-spacing" id="cancel-row">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-6">
                <div class="___class_+?3___">
                    <div id="multi-column-ordering_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">

                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="___class____">User Management</h3>
                            </div>
                            <div class="col-md-6 text-md-right">
                                <a href="{{ route('admin.user.add') }}" type="button"
                                    class="btn btn-primary btn-rounded mb-2 ">Add User</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">

                                <table id="default-ordering" class="table table-hover dataTable" style="width: 100%;"
                                role="grid" aria-describedby="multi-column-ordering_info">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Name</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Roles</th>
                                            <th class="text-center" width="20%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($allUsers as $user)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>
                                                    <div>{{ $user->username }}</div>
                                                </td>
                                                <td>
                                                    <p class="text-danger">{{ $user->email }}</p>
                                                </td>
                                                <td>
                                                    {{-- @dd(($user->roles->pluck('name')->toArray())) --}}
                                                    <p class="text-danger">
                                                        {{ implode(', ', $user->roles->pluck('name')->toArray()) }}
                                                    </p>
                                                </td>
                                                <td >

                                                    <a
                                                        href="{{ route('admin.user.edit', $user->username) }}"
                                                        type="button" class="btn btn-sm btn-primary">Edit</a>
                                                    <a
                                                        href="{{ route('admin.user.toggleActive', $user->username) }}"
                                                        type="button" class="btn btn-sm btn-{{$user->deleted_at == null ? "success" : "danger" }}">
                                                        {{$user->deleted_at == null ? "Active" : "Inactive" }}
                                                    </a>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('scripts')
    <script src="{{ asset('panel/plugins/table/datatable/datatables.js') }}"></script>
    <script>
        $('#default-ordering').DataTable({
            "oLanguage": {
                "oPaginate": {
                    "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                    "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
                },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
                "sLengthMenu": "Results :  _MENU_",
            },
            "order": [
                [3, "desc"]
            ],
            "stripeClasses": [],
            "lengthMenu": [10, 20, 50],
            "pageLength": 10,
            drawCallback: function() {
                $('.dataTables_paginate > .pagination').addClass(
                    ' pagination-style-13 pagination-bordered mb-5');
            }
        });
    </script>
@endpush
