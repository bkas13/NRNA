@extends('commonDashboard.master')
@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

@endpush
@section('content')
    <div class="mt-3 mb-2">
        <h4 class="mt-0 header-title">Banner Management </h4>
    </div>
    <div class="row layout-top-spacing" id="cancel-row">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-6">
                <div class="___class_+?3___">
                    <div id="multi-column-ordering_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">

                        <div class="row">
                            <div class="col-md-12 text-md-right"> <a href="{{ route('individual.settings.bannerAdd') }}"
                                    type="button" class="btn btn-primary btn-rounded mb-2 ">Add
                                    Banner</a>

                            </div>
                        </div>
                        <table id="datatable" class="table table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Banner Title</th>
                                    <th>Subtitle</th>
                                    <th>Link</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($banners as $banner)
                                    {{-- @dd($banner) --}}
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ Illuminate\Support\Str::limit($banner->title, 30) }}</td>
                                        <td>{{ Illuminate\Support\Str::limit($banner->subtitle, 80) }}</td>
                                        <td>{{ $banner->link }}</td>
                                        <td>
                                            <img src="{{ isset($banner->banner_image) ? getMediaUrl($banner->banner_image->path) : ' ' }}"
                                                height="100px" width="100px" alt="feature Image">
                                        </td>
                                        <td>
                                            <span @if ($banner->status == 'Active')?
                                                class="badge badge-pill badge-success"
                                            @else
                                                class="badge badge-pill badge-danger"
                                @endif>{{ $banner->status }}</span>
                                </td>

                                <td class="text-center">
                                    {{-- <a href="{{ route('region.settings.viewBanner', $banner->id) }}"
                                        class="btn btn-success btn-icon-text p-1" title="View Banner Details">
                                        <i class="fa fa-image fa-2x"></i>
                                    </a> --}}
                                    <a href="{{ route('individual.settings.bannerEdit', $banner->id) }}" type="button"
                                        class="btn btn-primary btn-rounded p-2">
                                        <i data-feather="edit"></i>
                                    </a>
                                    <a href="{{ route('individual.settings.bannerDestroy', $banner->id) }}" type="button"
                                        class="btn btn-danger btn-rounded p-2">
                                        <svg xmlns="
                                                                                http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
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
                                @endforeach
                            </tbody>
                        </table>
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
