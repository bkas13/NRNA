<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>NRN Dashboard</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('panel/assets/img/favicon.ico') }}" />
    <link href="{{ asset('panel/assets/css/loader.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('panel/assets/js/loader.js') }}"></script>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="{{ asset('panel/assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/css/toastr.min.css"
        integrity="sha512-HPSfJxnyVYJb4v9afT3fXvs0mXvdg/C7eYxBl1EYS7uQHuCU/0lSGhaH9o23Tw8FofBiGQfFWzMYD9TqK8tv/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

    <!-- END GLOBAL MANDATORY STYLES -->

    @stack('styles')

</head>

<body>
    <!-- BEGIN LOADER -->
    {{-- <div id="load_screen">
        <div class="loader">
            <div class="loader-content">
                <div class="spinner-grow align-self-center"></div>
            </div>
        </div>
    </div> --}}
    <!--  END LOADER -->
    <!--  BEGIN NAVBAR  -->
    @include('commonDashboard.navbar')
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>
        <!--  BEGIN SIDEBAR  -->
        @include('commonDashboard.specific_sidebar')
        <!--  END SIDEBAR  -->
        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">
                @yield('content')
                <!--  BEGIN FOOTER-->
                @include('commonDashboard.footer')
                <!--  END FOOTER  -->

            </div>
        </div>
        <!--  END CONTENT AREA  -->
    </div>
    <!-- END MAIN CONTAINER -->
    <!-- BEGIN SCRIPTS SECTION -->
    <div>
        <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->

        {{-- ----------------------------TOASTR SCRIPT------------------------ --}}
        <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.min.js"
                integrity="sha512-i5xofbBta9oP3xclkdj0jO68kXE1tPeN8Jf3rwzsbwNrpFVifjhklWi8zMOOUscuMQaCPyIXl0TMWFjGwBaJxw=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script> {!! Toastr::message() !!}
        {{-- ----------------------------END OF TOASTR SCRIPT------------------------ --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
                integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        </script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
                integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"
                integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous">
        </script>
        <script src="{{ asset('panel/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
        <script src="{{ asset('panel/assets/js/app.js') }}"></script>
        <script>
            $(document).ready(function() {
                App.init();
            });
        </script>
        <script src="{{ asset('panel/assets/js/custom.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.summernote').summernote({
                    height: 150,
                    toolbar: [
                        // [groupName, [list of button]]
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['font', ['strikethrough', 'superscript', 'subscript']],
                        ['fontsize', ['fontsize']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['height', ['height']]
                    ]
                });
            });
        </script>

        <script src="{{asset('panel/plugins/font-icons/feather/feather.min.js')}}"></script>
        <script type="text/javascript">
            feather.replace();
        </script>
        <!-- END GLOBAL MANDATORY SCRIPTS -->

        @stack('scripts')
    </div>
    <!-- END SCRIPTS SECTION -->
</body>

</html>
