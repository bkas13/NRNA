@extends('commonDashboard.master')
@push('styles')
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="{{ asset('panel/plugins/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('panel/assets/css/dashboard/dash_1.css') }}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
@endpush
@section('content')

    <div class="layout-px-spacing">
      <h3 class="text-center mt-3 p-2">Dashboard</h3>
    </div>

@endsection
@push('scripts')
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="{{ asset('panel/plugins/apex/apexcharts.min.js') }}"></script>
    <script src="{{ asset('panel/assets/js/dashboard/dash_1.js') }}"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
@endpush
