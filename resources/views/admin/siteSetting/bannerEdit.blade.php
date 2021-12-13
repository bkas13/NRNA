@extends('commonDashboard.master')
@push('styles')
    <link href="{{ asset('panel/plugins/file-upload/file-upload-with-preview.min.css') }}" rel="stylesheet"
        type="text/css" />
@endpush
@section('content')

    <div class="row">
        <div class="col-11" style="margin-left:6%;">
            <div class="card m-b-25">
                <div class="card-body">
                    <div class="row mt-2 mb-3">
                        <div class="col-md-6">
                            <h4 class="mt-2 ml-3 header-title">Edit Banner</h4>

                        </div>
                        <div class="col-md-6 text-md-right">
                            <a href="{{ route('admin.settings.bannerIndex') }}" class="btn btn-primary" type="button">
                                Back to all banners
                            </a>
                        </div>
                    </div>


                    <div class="col-md-12 ml-0">
                        <form action="{{ route('admin.settings.bannerUpdate',$banner->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            {{-- <input type="hidden" name="news_id" value="{{ $singleNews->id }}"> --}}
                            @include('admin.siteSetting.bannerCommonform')
                            <div class="form-group mt-1">
                                <button class="btn btn-primary" type="submit">Edit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('panel/plugins/file-upload/file-upload-with-preview.min.js') }}"></script>

    <script>
        @if (isset($banner->banner_image))
            var importedBaseImage = "{{ getMediaUrl($banner->banner_image->path) }}";
            var firstUpload = new FileUploadWithPreview('bannerImageId', {
            images: {
            baseImage: importedBaseImage,
            },
            });
        @else
            var firstUpload = new FileUploadWithPreview('bannerImageId');
        @endif
    </script>
@endpush
