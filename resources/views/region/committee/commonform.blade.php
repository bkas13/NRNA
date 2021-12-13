{{-- @dd($candidate) --}}

<div class="row mb-4">
    <div class="form-group col-md-6">
        <label for="first_name">First Name <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name"
            value="{{ old('first_name', $candidate->first_name ?? '') }}">
        @error('first_name')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group col-md-6">
        <label for="last_name">Last Name <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name"
            value="{{ old('last_name', $candidate->last_name ?? '') }}">
        @error('last_name')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group col-md-6">
        <label for="email">Email <span class="text-danger">*</span></label>
        <input type="email" class="form-control" name="email" id="email" placeholder="Email"
            value="{{ old('email', $candidate->email ?? '') }}">
        @error('email')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group col-md-6">
        <label for="phone">Phone Number <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone Number"
            value="{{ old('phone', $candidate->phone ?? '') }}">
        @error('phone')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <input type="hidden" name="region" value="{{Auth::id()}}" required>

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
        @if ($candidate->profile_image)
            var importedBaseImage = "{{ $candidate->profile_image }}";
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
