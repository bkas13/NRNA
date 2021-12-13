{{-- @dd($banner) --}}
<div class="cold-md-12">
    <div class="form-row">
        <div class="form-group mt-2 p-3 col-md-6">
            <label for="">Banner Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $banner->title ?? '') }}"
                placeholder="Banner Title ...">
            @error('title')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mt-2 p-3 col-md-6">
            <label for="">Banner Link</label>
            <input type="text" name="link" class="form-control" value="{{ old('subtitle', $banner->link ?? '') }}"
                placeholder="Banner Link...">
            @error('link')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="form-group mt-2">
        <label for="">Status</label><br>
        <select class="custom-select" name="status" id="inputGroupSelect01">
            <option value="active" @if (isset($banner))
                @if ($banner->status === 'Active')
                    selected
                @endif
                @endif
                >Active
            </option>
            <option value="inactive" @if (isset($banner))
                @if ($banner->status === 'Inactive')
                    selected
                @endif
                @endif>InActive
            </option>
        </select>
        @error('status')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>
<div class="cold-md-12">
    <div class="form-row">
        <div class="form-group mt-2 col-md-6 p-3">
            <label for="">Banner Subtitle</label>
            <textarea name="subtitle" class="summernote">
                    {!! $banner->subtitle ?? '' !!}
            </textarea>
            @error('subtitle')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-4 col-md-6 p-3">
            <div class="custom-file-container " data-upload-id="bannerImageId">
                <label>Upload Banner Image <a href="javascript:void(0)" class="custom-file-container__image-clear"
                        title="Clear Image">x</a></label>
                <label class="custom-file-container__custom-file">
                    <input type="file" name="image" class="custom-file-container__custom-file__custom-file-input"
                        accept="image/*">
                    {{-- <input type="hidden" name="MAX_FILE_SIZE" value="10485760" /> --}}
                    <span class="custom-file-container__custom-file__custom-file-control"></span>
                </label>
                <div class="custom-file-container__image-preview"></div>
            </div>
            @error('image')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>




















{{-- <div class="row mb-4">
    <div class="form-group col-md-6">
        <label for="title">Title <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="title" id="title" placeholder="Title"
            value="{{ old('title', $news->title ?? '') }}">
        @error('title')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group col-md-6">
        <label for="description">Description<span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="description" id="description" placeholder="Last Name"
            value="{{ old('description', $news->description ?? '') }}">
        @error('description')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group col-md-6">
        <label for="email">Email <span class="text-danger">*</span></label>
        <input type="email" class="form-control" name="email" id="email" placeholder="Email"
            value="{{ old('email', $news->email ?? '') }}">
        @error('email')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group col-md-6">
        <label for="phone">Phone Number <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone Number"
            value="{{ old('phone', $news->phone ?? '') }}">
        @error('phone')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="region">Select Region:</label>
        <select name="region" id="region" class="form-control" required>
            <option value="" selected disabled="disabled">Select a Region</option>
            @foreach ($regionalUsers as $user)
                <option value={{ $user->id }} @if (isset($news))
                    @if ($news->regional_id == $user->id)
                        selected
                    @endif
            @endif>{{ $user->name }}</option>
            @endforeach

        </select>
    </div>

    <div class="form-group mb-4 col-md-8">
        <div class="custom-file-container " data-upload-id="myFirstImage">
            <label>Upload Profile Image <a href="javascript:void(0)" class="custom-file-container__image-clear"
                    title="Clear Image">x</a></label>
            <label class="custom-file-container__custom-file">
                <input type="file" name="image" class="custom-file-container__custom-file__custom-file-input"
                    accept="image/*">
                <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                <span class="custom-file-container__custom-file__custom-file-control"></span>
            </label>
            <div class="custom-file-container__image-preview"></div>
        </div>
    </div>
</div>
{{-- @push('scripts')
    <script src="{{ asset('panel/plugins/file-upload/file-upload-with-preview.min.js') }}"></script>

    <script>
        @if ($news->profile_image)
            var importedBaseImage = "{{ $news->profile_image }}";
            var firstUpload = new FileUploadWithPreview('myFirstImage', {
            images: {
            baseImage: importedBaseImage,
            },
            });
        @else
            var firstUpload = new FileUploadWithPreview('myFirstImage');
        @endif
    </script>
@endpush --}}
