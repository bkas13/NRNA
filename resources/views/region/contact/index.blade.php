@extends('commonDashboard.master')
@push('styles')
    <link href="{{ asset('panel/plugins/animate/animate.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('panel/plugins/table/datatable/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('panel/plugins/table/datatable/dt-global_style.css') }}">
@endpush
@section('content')
    <h3>All Contact Us Data</h3>
    <div class="row layout-top-spacing" id="cancel-row">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-6">
                <div class="table-responsive mb-4 mt-4">
                    <div id="multi-column-ordering_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">

                        <div class="row">
                            <div class="col-sm-12">
                                <table id="default-ordering" class="table table-hover dataTable" style="width: 100%;"
                                    role="grid" aria-describedby="multi-column-ordering_info">
                                    <thead>
                                        <tr>
                                            <th rowspan="1" colspan="1">Name</th>
                                            <th rowspan="1" colspan="1">Email</th>
                                            <th rowspan="1" colspan="1">Phone</th>
                                            <th rowspan="1" colspan="1">Message</th>
                                            <th rowspan="1" colspan="1">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($regionContacts as $contact)
                                            <tr role="row">


                                                <td class="sorting_1">{{ $contact->name }}</td>
                                                <td>{{ $contact->email }}</td>
                                                <td>{{ $contact->phone }}</td>
                                                <td>
                                                    <div>
                                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                                            data-target="#messageId{{$contact->id}}">
                                                            View Message
                                                        </button>
                                                    </div>
                                                </td>
                                                <td> <a href="{{ route('region.contact.deleteContact', $contact->id) }}"
                                                        type="button"
                                                        class="btn btn-danger btn-rounded p-2">
                                                           <svg xmlns="
                                                        http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-trash-2">
                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                        <path
                                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                        </path>
                                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                                        </svg>
                                                    </a>
                                                </td>
                                            </tr>
                                            {{-- -------------------------MESSAGE MODAL---------------- --}}
                                            <div class="modal fade" id="messageId{{$contact->id}}" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">

                                                        <div class="modal-body">
                                                            <p class="modal-text">{{ $contact->message }} </p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn" data-dismiss="modal"><i
                                                                    class="flaticon-cancel-12"></i> Close </button>
                                                            {{-- <button type="button" class="btn btn-primary">Save</button> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- -------------------------MESSAGE MODAL---------------- --}}
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th rowspan="1" colspan="1">Name</th>
                                            <th rowspan="1" colspan="1">Email</th>
                                            <th rowspan="1" colspan="1">Phone</th>
                                            <th rowspan="1" colspan="1">Message</th>
                                            <th rowspan="1" colspan="1">Action</th>
                                        </tr>
                                    </tfoot>
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
