@extends('commonDashboard.master')

@push('styles')

    {{-- Page specific styles --}}
    <style>
        .preview_image img {
            max-width: 200px;
            height: auto;
        }

    </style>

@endpush

@section('content')
    {{-- @dd($singleNews) --}}
    {{-- Page Specific Content --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-center" id="title">Upload Gallery Images:
                        <br>
                        <span style="color: red;">
                            Warning, Images shall be directly deleted...
                        </span>
                    </h5>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="jumbotron">
                                <h3 class="text-center" id="no_image" style="display: none;">
                                    No images in this album. Upload Below.
                                </h3>
                                <div class="alert alert-danger print-error-msg" style="display:none">
                                    <ul></ul>
                                </div>
                                <div class="row preview_image">

                                </div>
                                <br>
                                <hr>
                                <hr>
                                <div class="progress mt-2">
                                    <div class="progress-bar bg-success progress-bar-striped progress-bar-animated"></div>
                                </div>
                                <div class="row">


                                    <div class="col-md-4 form-group" id="imageselect_div">
                                        <label for="" class="mb-2">Upload Image</label>
                                        <input id="image_submit" type="file" name="news_gallery_image"
                                            class="form-control mb-2">
                                        <span style="color: red" class="mt-3">* Maximum File Size : 1 MB *</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>



@endsection


@push('scripts')

    {{-- Page specific scripts --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"
        integrity="sha512-eYSzo+20ajZMRsjxB6L7eyqo5kuXuS2+wEbbOkpaur+sA2shQameiJiWEzCIDwJqaB0a4a6tCuEvCOBHUg3Skg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            get_images();
        });

        function get_images() {

            $.ajax({

                url: '{{ route("region.news.get_images", $singleNews->id) }}',
                contentType: false,
                processData: false,
                method: 'get',
                // data: formData,
                success: function(result) {
                    $('.preview_image').empty();
                    var images = result;
                    if (images.length < 1) {
                                        //    console.log('No Images');
                        $('#no_image').show();
                    } else {
                        $('#no_image').hide();
                        $.each(images, function(key, value) {
                            url = value.url;
                            var preview = jQuery("<div class='col-md-3 mt-3'>" +
                                "<div class='card'>" +
                                "<div class='card-body text-center'>" +
                                "<a href='" + url + "' >" +
                                "<img src='" + url +
                                "' alt='Click To View File' style='height: 100px; width: auto' />" +
                                "</a>" +
                                "</div>" +
                                "<div class='card-footer text-center'>" +
                                "<button class='btn btn-danger text-center delete_document' value='" +
                                value.id + "'>Delete</button>" +
                                "<br>" +
                                "</div>" +
                                "</div>" +
                                "</div>");

                            $('.preview_image').append(preview);
                        })
                    }
                    // location.reload();


                },
                error: function(data) {
                    // console.log(data);
                }
            });


        }
    </script>

    <script>
        $('#image_submit').on('change', function() {

            console.log('images submit');
            var formData = new FormData();
            var myFile = $('#image_submit').prop('files')[0];
            console.log(myFile);
            formData.append('news_gallery_image', myFile);
            $.ajaxSetup({

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
            });

            $.ajax({
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = ((evt.loaded / evt.total) * 100);
                            $(".progress-bar").width(percentComplete + '%');
                            $(".progress-bar").html(Math.round(percentComplete) + '%');
                            if (Math.round(percentComplete == 100)) {
                                $(".progress-bar").html('Completed');
                                $(".progress-bar").addClass('bg-primary');
                            }
                        }
                    }, false);
                    return xhr;
                },
                url: '{{ route("region.news.upload_gallery", $singleNews->id) }}',
                contentType: false,
                processData: false,
                method: 'POST',
                data: formData,
                beforeSend: function() {
                    console.log("hello");
                    $('#imageselect_div').hide();
                    $(".progress-bar").width('0%');
                    // $.blockUI({ message: $('#throbber') });
                },
                success: function(result) {
                    // console.log(result);
                    get_images();
                    $("#image_submit").val(null);
                    $("#imageselect_div").show();

                    $(".progress-bar").html('Image Successfully Uploaded.');
                    $(".progress-bar").hide();

                },
                error: function(data) {
                    printErrorMsg(data.responseJSON.error);
                    $("#image_submit").val(null);
                    $("#imageselect_div").show();
                    $(".progress-bar").html('Error');
                    $(".progress-bar").addClass('bg-danger');
                    document.getElementById('title').scrollIntoView({
                        behavior: "smooth",
                        block: "end",
                        inline: "nearest"
                    });
                }

            })
        });

        function printErrorMsg(msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display', 'block');
            $.each(msg, function(key, value) {
                $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
            });
        }
    </script>

    <script>
        jQuery(document).on('click', '.delete_document', function(e) {
            e.preventDefault();
            var imageId = $(this).val();
            var url = '{{ route("region.news.delete_gallery", ':imageId') }}';
            url = url.replace(':imageId', imageId);
            $.ajax({
                url: url,
                contentType: false,
                processData: false,
                method: 'get',
                // data: formData,
                success: function(result) {
                    get_images();
                    // location.reload();
                },
                error: function(data) {
                    // console.log(data);
                }
            });
        });
    </script>

@endpush
