@extends('commonDashboard.master')
@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endpush
@section('content')

    <div class="row layout-top-spacing" id="cancel-row">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-6">
                <div class="___class_+?3___">
                    <div id="multi-column-ordering_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">

                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="___class____">Committee Member Management</h3>
                            </div>
                            <div class="col-md-6 text-md-right">
                                <a href="{{ route('region.committee.add') }}" type="button"
                                    class="btn btn-primary btn-rounded mb-2 ">Add Member</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="multi-column-ordering" class="table table-hover dataTable" style="width: 100%;"
                                    role="grid" aria-describedby="multi-column-ordering_info">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($candidates as $candidate)
                                            <tr role="row">
                                                <td class="sorting_1 sorting_2">
                                                    <div class="d-flex">
                                                        <div class="usr-img-frame mr-2 rounded-circle">
                                                            <img alt="avatar" class="img-fluid rounded-circle"
                                                                src="{{ asset($candidate->profileImage->path ?? 'panel/assets/img/90x90.jpg') }}">
                                                        </div>
                                                        <p class="align-self-center mb-0 admin-name">
                                                            {{ $loop->iteration }}</p>
                                                    </div>
                                                </td>
                                                <td>{{ $candidate->first_name }}</td>
                                                <td>{{ $candidate->last_name }}</td>
                                                <td>{{ $candidate->email }}</td>
                                                <td>{{ $candidate->phone }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('region.committee.edit', $candidate->slug) }}"
                                                        type="button" class="btn btn-primary btn-rounded p-2">
                                                        <i data-feather="edit-2"></i>
                                                    </a>
                                                    <a href="{{ route('region.committee.delete', $candidate->slug) }}"
                                                        type="button"
                                                        class="btn btn-danger btn-rounded p-2">
                                                        <i data-feather="trash"></i>
                                                    </a>
                                                    <a href="{{ route('region.committee.profile', $candidate->slug) }}"
                                                        type="button"
                                                        class="btn btn-success btn-rounded p-2">
                                                        <i data-feather="info"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach


                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th class="text-center">Action</th>
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
        $('#multi-column-ordering').DataTable({
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
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 7,
            columnDefs: [{
                targets: [0],
                orderData: [0, 1]
            }, {
                targets: [1],
                orderData: [1, 0]
            }, {
                targets: [4],
                orderData: [4, 0]
            }]
        });
    </script>
@endpush
