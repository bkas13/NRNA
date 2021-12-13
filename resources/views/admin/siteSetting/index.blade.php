@extends('commonDashboard.master')
@push('styles')
    <link href="{{ asset('panel/plugins/file-upload/file-upload-with-preview.min.css') }}" rel="stylesheet"
        type="text/css" />
@endpush
@section('content')
    <div class="row">
        <div class="col-12">
            <form action="{{ route('admin.addRegionSiteSetting') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mt-2 mb-3">
                    <div class="col-md-6">
                        <h4 class="mt-2 ml-3 header-title">Settings</h4>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="form-row mb-4">
                            <div class="col-md-12 mb-2">
                                <h3 class="text-center">Settings Data</h3>
                            </div>
                            <div class="col-md-6">

                                <div class="form-group mt-2">
                                    <label for="address">Address</label>
                                    <input type="text" name="address" placeholder="Enter Address.." class="form-control"
                                        value="{{ old('address', $settingsData['address'] ?? '') }}">
                                </div>
                                <div class="form-group mt-2">
                                    <label for="phone">Phone Number</label>
                                    <input type="text" name="phone" placeholder="Enter Phone.." class="form-control"
                                        value="{{ old('phone', $settingsData['phone'] ?? '') }}">
                                </div>
                                <div class="form-group mt-2">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" placeholder="Enter Email.." class="form-control"
                                        value="{{ old('email', $settingsData['email'] ?? '') }}">
                                </div>
                            </div>

                            <div class="col-md-6">

                                <div class="form-group mb-4 col-md-8">
                                    <div class="custom-file-container " data-upload-id="logoId">
                                        <label>Upload Logo <a href="javascript:void(0)"
                                                class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                                        <label class="custom-file-container__custom-file">
                                            <input type="file" name="region_logo"
                                                class="custom-file-container__custom-file__custom-file-input"
                                                accept="image/*">
                                            {{-- <input type="hidden" name="MAX_FILE_SIZE" value="10485760" /> --}}
                                            <span class="custom-file-container__custom-file__custom-file-control"></span>
                                        </label>
                                        <div class="custom-file-container__image-preview"></div>
                                    </div>
                                    @error('region_logo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-3 mt-2">
                    <div class="card-body">
                        <div class="form-row mb-4">
                            <div class="col-md-12 mb-2">
                                <h3 class="text-center">About Section</h3>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mt-2">
                                    <label for="subtitle">About</label>
                                    <textarea name="about"
                                        class="summernote">{{ old('about', $settingsData['about'] ?? '') }}</textarea>
                                    @error('about')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">

                                <div class="form-group mb-4 col-md-8">
                                    <div class="custom-file-container " data-upload-id="aboutId">
                                        <label>Upload About Image <a href="javascript:void(0)"
                                                class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                                        <label class="custom-file-container__custom-file">
                                            <input type="file" name="about_image"
                                                class="custom-file-container__custom-file__custom-file-input"
                                                accept="image/*">
                                            {{-- <input type="hidden" name="MAX_FILE_SIZE" value="10485760" /> --}}
                                            <span class="custom-file-container__custom-file__custom-file-control"></span>
                                        </label>
                                        <div class="custom-file-container__image-preview"></div>
                                    </div>
                                    @error('about_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-3 mt-2">
                    <div class="card-body">
                        <div class="form-row mb-4">
                            <div class="col-md-12 mb-2">
                                <h3 class="text-center">Tagline</h3>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mt-2">
                                    <label for="subtitle">Tagline Author</label>
                                    <input class="form-control" type="text" name="tagline_author" value="{{ old('tagline', $settingsData['tagline_author'] ?? '') }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mt-2">
                                    <label for="subtitle">Tagline Description</label>
                                    <textarea name="tagline"
                                        class="summernote">{{ old('tagline', $settingsData['tagline'] ?? '') }}</textarea>
                                    @error('about')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Submit</button>

            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('panel/plugins/file-upload/file-upload-with-preview.min.js') }}"></script>
    <script>
        //Banner_image Upload

        //about_image upload
        @if ($settingsImages->about_image)
            var importedAboutImage="{{ getMediaUrl($settingsImages->about_image->path) }}";
            var firstUpload= new FileUploadWithPreview('aboutId',{
            images:{
            baseImage:importedAboutImage,
            },
            });
        @else
            var firstUpload = new FileUploadWithPreview('aboutId');
        @endif

        //region_logo upload
        @if ($settingsImages->region_logo)
            var importedLogoImage="{{ getMediaUrl($settingsImages->region_logo->path) }}";
            var firstUpload= new FileUploadWithPreview('logoId',{
            images:{
            baseImage:importedLogoImage,
            },
            });
        @else
            var firstUpload = new FileUploadWithPreview('logoId');
        @endif
    </script>
@endpush
