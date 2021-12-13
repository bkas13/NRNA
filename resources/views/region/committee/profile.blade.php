@extends('commonDashboard.master')

@push('styles')
    <link href="{{ asset('panel/plugins/file-upload/file-upload-with-preview.min.css') }}" rel="stylesheet"
        type="text/css" />
@endpush

@section('content')

    <div class="row layout-top-spacing" id="cancel-row">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="___class_+?3___">
                <form method="post" action={{ route('region.committee.update_profile', $candidate->slug) }}
                    enctype="multipart/form-data">
                    @csrf
                    <div id="multi-column-ordering_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">

                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="___class____">Committee Profile : {{ $candidate->name }}</h3>
                            </div>
                            <div class="col-md-6 text-md-right">
                                <a href="{{ route('region.committee.all') }}" type="button"
                                    class="btn btn-primary btn-rounded mb-2 ">All Members</a>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area br-6 box box-shadow mb-3">
                            <div class="row">
                                <div class="col-12">
                                    <h3 class="text-center">Basic Info</h3>
                                </div>
                                <div class="col-6 form-group">
                                    <p>Address</p>
                                    <label for="address" class="sr-only">Address</label>
                                    <input type="text" name="address" class="form-control" id="address"
                                        placeholder=" 123 Main Street, London"
                                        value="{{ $candidateMeta['address'] ?? '' }}">
                                    <small class="text-danger alert-message">{{ $errors->first('address') }}</small>
                                </div>
                                <div class="col-6 form-group">
                                    <p>Email</p>
                                    <label for="email" class="sr-only">Email</label>
                                    <input type="text" name="email" class="form-control" id="email"
                                        placeholder="example@app.com" value="{{ $candidateMeta['email'] ?? $candidate->email }}">
                                    <small class="text-danger alert-message">{{ $errors->first('email') }}</small>
                                </div>
                                <div class="col-6 form-group">
                                    <p>Phone</p>
                                    <label for="phone" class="sr-only">Phone</label>
                                    <input type="text" name="phone" class="form-control" id="phone"
                                        placeholder="+011 - 937364338" value="{{ $candidateMeta['phone'] ?? $candidate->phone }}">
                                    <small class="text-danger alert-message">{{ $errors->first('phone') }}</small>
                                </div>
                                <div class="col-6 form-group">
                                    <p>Designation</p>
                                    <label for="designation" class="sr-only">Designation</label>
                                    <input type="text" name="designation" class="form-control"
                                        placeholder="Professor, Architect"
                                        value="{{ $candidateMeta['designation'] ?? '' }}">
                                    <small class="text-danger alert-message">{{ $errors->first('Designation') }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area br-6 box box-shadow mb-3">
                            <div class="row">
                                <div class="col-12">
                                    <h3 class="text-center">Social Accounts</h3>
                                </div>
                                <div class="col-6 form-group">
                                    <p>Facebook</p>
                                    <label for="facebook" class="sr-only">Facebook</label>
                                    <input type="text" name="facebook" class="form-control" id="facebook"
                                        placeholder="https://facebook.com/anonymous"
                                        value="{{ $candidateMeta['facebook'] ?? '' }}">
                                    <small class="text-danger alert-message">{{ $errors->first('facebook') }}</small>
                                </div>
                                <div class="col-6 form-group">
                                    <p>Instagram</p>
                                    <label for="instagram" class="sr-only">Instagram</label>
                                    <input type="text" name="instagram" class="form-control" id="instagram"
                                        placeholder="https://instagram.com/anonymous"
                                        value="{{ $candidateMeta['instagram'] ?? '' }}">
                                    <small class="text-danger alert-message">{{ $errors->first('instagram') }}</small>
                                </div>
                                <div class="col-6 form-group">
                                    <p>Twitter</p>
                                    <label for="twitter" class="sr-only">Twitter</label>
                                    <input type="text" name="twitter" class="form-control" id="twitter"
                                        placeholder="https://twitter.com/anonymous"
                                        value="{{ $candidateMeta['twitter'] ?? '' }}">
                                    <small class="text-danger alert-message">{{ $errors->first('twitter') }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area br-6 box box-shadow mb-3">
                            <div class="row">
                                <div class="col-12">
                                    <h3 class="text-center">
                                        Description Section
                                        <button class="btn btn-sm btn-primary add_button" type="button">
                                            <i class="fa fa-plus">Add New</i>
                                        </button </h3>
                                </div>
                            </div>
                            <div class="mt-3 description-wrapper">
                                @if (isset($candidateMeta['dynamic_description']))
                                    {{-- @dd($candidateMeta['dynamic_description']); --}}
                                    @foreach ($candidateMeta['dynamic_description'] as $description)
                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <label for="title_name_dynamic">Heading Title</label>
                                                    <input type="text" name="dynamic_title[]" class="form-control"
                                                        id="title_name_dynamic" value="{{ $description->title ?? '' }}"
                                                        placeholder="Enter title">
                                                </div>
                                            </div>
                                            <div class="col-md-10">
                                                <div class="mb-3">
                                                    <label for="description">Description</label>
                                                    <textarea class="textarea" name="dynamic_description[]"
                                                        id="info_name_dynamic" rows="3"
                                                        style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                                                        placeholder="Place some text here">{!! $description->description ?? '' !!}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <button class="btn btn-sm btn-danger remove_button"
                                                    type="button">Remove</button>
                                            </div>
                                            <div class="col-12">
                                                <hr>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="widget-content widget-content-area br-6 box box-shadow mb-3">
                            <div class="row">
                                <div class="col-12">
                                    <h3 class="text-center">
                                        Image
                                    </h3>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-4 col-md-8">
                                        <div class="custom-file-container " data-upload-id="candidateImageId">
                                            <label>Upload Candidate Image <a href="javascript:void(0)"
                                                    class="custom-file-container__image-clear"
                                                    title="Clear Image">x</a></label>
                                            <label class="custom-file-container__custom-file">
                                                <input type="file" name="candidate_image"
                                                    class="custom-file-container__custom-file__custom-file-input"
                                                    accept="image/*">
                                                {{-- <input type="hidden" name="MAX_FILE_SIZE" value="10485760" /> --}}
                                                <span
                                                    class="custom-file-container__custom-file__custom-file-control"></span>
                                            </label>
                                            <div class="custom-file-container__image-preview"></div>
                                            @error('candidate_image')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-4 col-md-8">
                                        <div class="custom-file-container " data-upload-id="candidateBannerId">
                                            <label>Upload Candidate Banner Image <a href="javascript:void(0)"
                                                    class="custom-file-container__image-clear"
                                                    title="Clear Image">x</a></label>
                                            <label class="custom-file-container__custom-file">
                                                <input type="file" name="candidate_banner"
                                                    class="custom-file-container__custom-file__custom-file-input"
                                                    accept="image/*">
                                                {{-- <input type="hidden" name="MAX_FILE_SIZE" value="10485760" /> --}}
                                                <span
                                                    class="custom-file-container__custom-file__custom-file-control"></span>
                                            </label>
                                            <div class="custom-file-container__image-preview"></div>
                                            @error('candidate_banner')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 ">
                            <div class="mt-3 text-right">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            {{-- </div> --}}
        </div>

    @endsection

    @push('scripts')

        <script id="dynamic-template" type="text/x-custom-template">
            <div class="row">
                                                                                        <div class="col-md-10">
                                                                                            <div class="form-group">
                                                                                            <label for="title_name_dynamic">Heading Title</label>
                                                                                            <input type="text" name="dynamic_title[]" class="form-control" id="title_name_dynamic" placeholder="Enter title">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-10">
                                                                                            <div class="mb-3">
                                                                                                <label for="description">Description</label>
                                                                                                <textarea class="textarea" name="dynamic_description[]" id="info_name_dynamic" rows="3" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-2">
                                                                                            <button class="btn btn-sm btn-danger remove_button" type="button">Remove</button>
                                                                                        </div>
                                                                                        <div class="col-12"><hr></div>
                                                                                    </div>
                                                                                </script>

        <script>
            $(document).ready(function() {
                var addButton = $('.add_button'); //Add button selector
                var wrapper = $('.description-wrapper'); //Input field wrapper
                var fieldHTML = $('#dynamic-template').html();

                $(document).ready(function() {
                    $('.textarea').summernote();
                });

                //Once add button is clicked
                $(addButton).click(function() {
                    $(wrapper).append(fieldHTML); //Add field html
                    $(wrapper).find('.textarea').summernote()
                });

                //Once remove button is clicked
                $(wrapper).on('click', '.remove_button', function(e) {
                    e.preventDefault();
                    $(this).parent('div').parent('div').empty(); //Remove field html
                });
            });
        </script>
        <script>
            function generateRandomInteger() {
                return Math.floor(Math.random() * 90000) + 10000;
            }

            jQuery(document).on('click', '.btn-delete-description', function(e) {
                e.preventDefault();
                var $this = $(this);
                $this.closest(".div-description").remove();
            });

            jQuery(document).on('click', '.btn-add-description', function(e) {
                e.preventDefault();
                // console.log('tgd');
                var lastRow = $('.div-description .description-section').last().attr('data-row');
                var counter = lastRow ? parseInt(lastRow) + 1 : 1;
                var randomInteger = generateRandomInteger();
                var newRow = jQuery('<div class="description-section" data-row="' + counter + '">' +
                    '<td><textarea name="spec[title][' + randomInteger +
                    ']" class="form-control summernote" required></textarea></td>' +
                    // '<td><input type="text" name="features[feature][' + randomInteger + ']" class="form-control" required/></td>' +
                    '<td>' + '<textarea name="spec[specification][' + randomInteger +
                    ']" class="form-control" required></textarea>' +
                    '</td>' +
                    '<td><button type="button" class="btn btn-danger btn-sm btn-delete-specifications" data-feature=""><i class="fa fa-minus-circle"></i></button></td>' +
                    '</div>');
                jQuery('.div-description').append(newRow);
            });
        </script>
        <script src="{{ asset('panel/plugins/file-upload/file-upload-with-preview.min.js') }}"></script>

        <script>
            @if ($candidate->bannerImage)
                var importedBaseImage = "{{ getMediaUrl($candidate->bannerImage->path) }}";
                var firstUpload = new FileUploadWithPreview('candidateBannerId', {
                images: {
                baseImage: importedBaseImage,
                },
                });
            @else
                var firstUpload = new FileUploadWithPreview('candidateBannerId');
            @endif
        </script>
        <script>
            @if ($candidate->profileImage)
                var importedBaseImage = "{{ getMediaUrl($candidate->profileImage->path) }}";
                var firstUpload = new FileUploadWithPreview('candidateImageId', {
                images: {
                baseImage: importedBaseImage,
                },
                });
            @else
                var firstUpload = new FileUploadWithPreview('candidateImageId');
            @endif
        </script>

    @endpush
