@extends('commonDashboard.master')
@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endpush
@section('content')
    <div class="mt-3 mb-2">
        <h4 class="mt-0 header-title">News Management </h4>
    </div>
    <div class="row layout-top-spacing" id="cancel-row">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-6">
                <div class="___class_+?3___">
                    <div id="multi-column-ordering_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">

                        <div class="row">
                            <div class="col-md-12 text-md-right"> <a href="{{ route('individual.news.add') }}" type="button"
                                    class="btn btn-primary btn-rounded mb-2 ">Add
                                    News</a>

                            </div>
                        </div>
                        <table id="datatable" class="table table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>News Title</th>
                                    <th>Date</th>
                                    <th>Feature Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($news as $singleNews)
                                    <tr>
                                        {{-- @dd($singleNews->featureImage()->where('type','feature_image')->first()) --}}
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ Illuminate\Support\Str::limit($singleNews->title, 80) }}</td>
                                        <td>{{ $singleNews->created_at->format('Y-m-d') }}</td>
                                        <td>
                                            <img src="{{ isset($singleNews->featureImage) ? asset($singleNews->featureImage->path) : ' ' }}"
                                                height="100px" width="100px" alt="feature Image">
                                        </td>
                                        <td><span @if ($singleNews->status == 'Active')?
                                                class="badge badge-pill badge-success"
                                            @else
                                                class="badge badge-pill badge-danger"
                                @endif>{{ $singleNews->status }}</span></td>
                                <td>
                                    <a href="{{ route('individual.news.gallery', $singleNews->slug) }}"
                                        class="btn btn-success btn-icon-text p-1" title="Manage Gallery">
                                        <i class="fa fa-image fa-2x"></i>
                                    </a>
                                    <a href="{{ route('individual.news.edit', $singleNews->slug) }}"
                                        class="btn btn-primary btn-icon-text p-1" title="Edit">
                                        <i class="fa fa-edit fa-2x"></i>
                                    </a>
                                    {{-- @include('region.album.edit') --}}


                                    <a href="{{ route('individual.news.delete', $singleNews->slug) }}"
                                        class="btn btn-danger btn-icon-text p-1" title="Delete">
                                        <i class="fa fa-trash fa-2x"></i>
                                    </a>
                                    {{-- @include('region.album.delete') --}}

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
